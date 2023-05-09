<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                $this->category->create($request->all());
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
