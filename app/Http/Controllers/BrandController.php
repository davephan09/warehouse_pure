<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    private $brand;
    public function __construct(BrandRepository $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('brand.read')) {
            $data['title'] = trans('common.brands');
            $data['listStatus'] = ActiveStatus::asSelectArray();
            return view('brand.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('brand.read')) {
            $data['brands'] = $this->brand->getBrands($request);
            $data['htmlBrandTable'] = view('brand.brand_table', $data)->render();
            return $this->iRespond(true, "", $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->can('brand.create')) {
            $rules = [
                'name' => 'required|max:191|unique:brands',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $brand = $this->brand->addBrand($request);
                if ($brand) \Illuminate\Support\Facades\Log::info($user->username . ' has created a brand: ' . $brand->name);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return false;
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
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->can('brand.update')) {
            $id = intval($request->input('id'));
            $rules = [
                'name' => 'required|max:191|unique:brands,name,' . $id,
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $brand = $this->brand->updateBrand($request);
                if ($brand) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a brand: ' . $brand->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return false;
    }

    public function updateStatus(Request $request)
    {
        $user = Auth::user();
        if($user->can('brand.update')) {
            $rules = [
                'id' => 'required',
                'active' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $brand = $this->brand->updateStatusBrand($request);
                if ($brand) \Illuminate\Support\Facades\Log::info($user->username . ' has updated status for brand: ' . $brand->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if($user->can('brand.delete')) {
            $rules = [
                'id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $id = intval($request->input('id'));
                $brand = $this->brand->find($id);
                $brand->delete();
                if ($brand) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted brand: ' . $brand->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return false;
    }
}
