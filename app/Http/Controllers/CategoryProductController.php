<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class CategoryProductController extends Controller
{
    private $category;
    public function __construct(CategoryProductRepository $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('category_product.read')) {
            $data['title'] = trans('common.category_product');
            return view('category_product.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $data = array();
        $data['categories'] = $this->category->getAll();
        $data['htmlCategoryTable'] = view('category_product.category_table', $data)->render();
        return $this->iRespond(true, "", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->can('category_product.create')) {
            $data['title'] = trans('category.add');
            $data['productCategories'] = $this->category->getAll();
            return view('category_product.create', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {   
        $user = Auth::user();
        if ($user->can('category_product.create')) {
            try {
                $rules = [
                    'name' => 'required|max:191|unique:category_products',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $request->merge([
                    'user_add' => $user->id,
                    'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN)
                ]);
                $category = $this->category->create($request->all());
                if ($category) \Illuminate\Support\Facades\Log::info($user->username . ' has create a category: ' . $category->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
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
        if ($user->can('category_product.update')) {
            $id = intval($id);
            $data['title'] = trans('category.update');
            $data['category'] = $this->category->find($id);
            $data['productCategories'] = $this->category->getAll();
            return view('category_product.update', $data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->can('category_product.update')) {
            try {
                $id = intval($request->input('id'));
                $rules = [
                    'name' => 'required|max:191|unique:category_products,name,' . $id,
                    'id' => 'required|numeric'
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $category = $this->category->updateCat($request);
                if ($category) \Illuminate\Support\Facades\Log::info($user->username . ' has update a category: ' . $category->name);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->can('category_product.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = intval($request->input('id'));
                if (isset($id)) {
                    $category = $this->category->find($id);
                    $isDelete = $category->delete();
                    if ($isDelete) \Illuminate\Support\Facades\Log::info($user->username . ' has delete a category: ' . $category->name);
                }
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
}
