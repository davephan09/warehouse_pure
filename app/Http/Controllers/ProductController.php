<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Variation;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TaxRepository;
use App\Repositories\UnitRepository;
use App\Repositories\VariationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private $product;
    private $category;
    private $brand;
    private $unit;
    private $tax;
    private $variation;
    public function __construct(ProductRepository $product, CategoryProductRepository $category, BrandRepository $brand, UnitRepository $unit, TaxRepository $tax, VariationRepository $variation)
    {
        $this->product = $product;
        $this->category = $category;
        $this->brand = $brand;
        $this->unit = $unit;
        $this->tax = $tax;
        $this->variation = $variation;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('product.read')) {
            $data['title'] = trans('product.list');
            return view('product.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('product.read')) {
            $products = $this->product->filters([
                'relations' => ['category'],
            ]);
            $data['products'] = $products;
            $data['htmlProductTable'] = view('product.product_table', $data)->render();
            return $this->iRespond(true, '', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->can('product.create')) {
            $data['title'] = trans('product.add');
            $data['categories'] = $this->category->filters([
                'status' => true,
            ]);
            $data['brands'] = $this->brand->filters([
                'status' => true,
            ]);
            $data['variations'] = $this->variation->getActiveVariations();
            $data['options'] = $this->variation->getActiveOptions();
            $data['units'] = $this->unit->filters(['status' => true]);
            $data['taxes'] = $this->tax->filters(['status' => true]);
            $data['tags'] = Tag::orderBy('name', 'asc')->get(['id', 'name']);
            return view('product.create', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->can('product.create')) {
            DB::connection()->beginTransaction();
            try {
                $rules = [
                    'product_name' => 'required|string|max:191|unique:products',
                    'variations' => 'required',
                    'summary' => 'max:255|string',
                    'description' => 'max:10000',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $taxIds = $request->input('tax');
                $taxValues = $request->input('tax_value');
                $tags = $request->input('tags');
                $variations = $request->input('variations');
                $product = $this->product->addProduct($request);
                $this->product->addTag($product, $tags);
                $this->product->addTaxProduct($product, $taxIds, $taxValues);
                $this->product->addVariationProduct($product, $variations);
                if ($product) \Illuminate\Support\Facades\Log::info($user->username . ' has created a product: ' . $product->toJson());
                DB::connection()->commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user->can('product.update')) {
            $id = intval(cleanInput($id));
            $data['title'] = trans('product.update');
            $product = $this->product->filters([
                'productId' => $id, 
                'relations' => ['category', 'tags', 'taxes', 'variations'],
            ]); 
            $variations = $product->variations;
            if ($variations->count() > 1) {
                $options = $variations->pluck('options');
                $options = $options->flatMap(function ($item) {
                    return json_decode($item);
                })->unique()->values()->all();
                $variationsProduct = $this->variation->getVariationByOptions($options);
                $data['variationsProduct'] = $variationsProduct->pluck('id');
                $data['options'] = $options;
            } else {
                $data['variationsProduct'] = [];
            }
            $taxes = $product->taxes;
            if ($taxes) {
                $taxes = $taxes->map(function ($item) {
                    return [$item->pivot_tax_id => $item->pivot_value];
                });
            }
            $data['product'] = $product;
            $data['productTags'] = $product->tags->pluck('id')->toArray();
            $data['brands'] = $this->brand->filters(['active' => true]);
            $data['units'] = $this->unit->filters(['active' => true]);
            $data['tags'] = Tag::orderBy('name', 'asc')->get(['id', 'name']);
            $data['allOptions'] = $this->variation->getActiveOptions();
            $data['categories'] = $this->category->filters(['active' => true]);
            $data['taxes'] = $this->tax->filters(['active' => true]);
            $data['variations'] = $this->variation->getActiveVariations();
            return view('product.update', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->can('product.update')) {
            DB::connection()->beginTransaction();
            try {
                $id = intval($request->input('id'));
                $rules = [
                    'product_name' => 'required|string|max:191|unique:products,product_name,' . $id,
                    'variations' => 'required',
                    'summary' => 'max:255|string',
                    'description' => 'max:10000',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $taxIds = $request->input('tax');
                $taxValues = $request->input('tax_value');
                $tags = $request->input('tags');
                $variations = $request->input('variations');
                $product = $this->product->find($id);
                $isUpdate = $this->product->updateProduct($request, $product);
                $this->product->addTag($product, $tags);
                $this->product->addTaxProduct($product, $taxIds, $taxValues);
                $this->product->deleteVariationProduct($product);
                $this->product->addVariationProduct($product, $variations);
                if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a product: ' . $product->toJson());
                DB::connection()->commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->can('product.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = intval(cleanInput($request->input('id')));
                if (isset($id)) {
                    $product = $this->product->deleteProduct($id);
                }
                DB::connection()->commit();
                if ($product) \Illuminate\Support\Facades\Log::info($user->username . ' has created a product: ' . $product->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }

    public function createTag(Request $request)
    {
        $user = Session::get('user');
        try {
            $rules = [
                'name' => 'required|string|min:1|max:100|unique:tags',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            $name = cleanInput($request->input('name'));
            if (!empty($name)) {
                $tag = $this->product->createTag($name);
                if ($tag) \Illuminate\Support\Facades\Log::info($user->username . ' has created a tag: ' . $tag->toJson());
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
            return $this->iRespond(false, 'error');
        }
        return $this->iRespond(true, 'success');
    }

    public function searchProduct(Request $request)
    {
        $user = Auth::user();
        if ($user->can('product.read')) {
            try {
                $text = $request->input('keyword');
                $text = trim(strip_tags(stripslashes($text['term'])));
                $products = $this->product->searchProduct($text);
                $products = $products->map(function($product) {
                    return [
                        'text' => $product->product_name . ' (' . $product->category->name . ')',
                        'children' => $product->variations->map(function($item) use($product) {
                            return [
                                'id' => $item->id,
                                'productId' => $product->id,
                                'text' => $item->name,
                                'textSelected' => $product->product_name . ' - ' . $item->name,
                            ];
                        })->all(),
                    ];
                })->values()->all();
                $data['products'] = $products;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success', $data);
        } 
        return response('error', 404, []);
    }
}
