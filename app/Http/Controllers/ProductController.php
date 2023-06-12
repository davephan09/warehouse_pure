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
            $products = $this->product->getProducts();
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
            $data['categories'] = $this->category->getAllActive();
            $data['brands'] = $this->brand->getActiveBrands();
            $data['variations'] = $this->variation->getActiveVariations();
            $data['options'] = $this->variation->getActiveOptions();
            $data['units'] = $this->unit->getActiveUnits();
            $data['taxes'] = $this->tax->getActiveTaxes();
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
            $id = intval($id);
            $data['title'] = trans('product.update');
            list($product, $varValue) = $this->product->getProduct($id);
            $data['product'] = $product;
            $data['productTags'] = $product->tags->pluck('id')->toArray();
            $data['varValue'] = $varValue;
            $data['brands'] = $this->brand->getActiveBrands();
            $data['units'] = $this->unit->getActiveUnits();
            $data['tags'] = Tag::orderBy('name', 'asc')->get(['id', 'name']);
            $data['categories'] = $this->category->getAllActive();
            $data['variations'] = Variation::get(['id', 'name'])->toArray();
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
                    'product_name' => 'required|max:191|unique:products,product_name,' . $id,
                    'product_code' => 'max:40|unique:products,product_code,' . $id,
                    'quantity' => 'required',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $product = $this->product->find($id);
                $tags = $request->input('tags');
                $variations = $request->input('variation');
                $varValues = $request->input('var_value');
                $isUpdate = $this->product->updateProduct($request, $product);
                $this->product->addTag($product, $tags);
                $this->product->addVariation($product, $variations, $varValues);
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
                $id = intval($request->input('id'));
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
                'name' => 'required|min:1|max:100|unique:tags',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            $name = trim($request->input('name'));
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
}
