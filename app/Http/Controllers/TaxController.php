<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Repositories\TaxRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    private $tax;
    public function __construct (TaxRepository $tax)
    {
        $this->tax = $tax;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('tax.read')) {
            $data['title'] = trans('common.taxes');
            $data['listStatus'] = ActiveStatus::asSelectArray();
            return view('tax.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('tax.read')) {
            $data['taxes'] = $this->tax->getTaxes($request);
            $data['htmlTaxTable'] = view('tax.tax_table', $data)->render();
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
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->can('tax.create')) {
            $rules = [
                'name' => 'required|max:191|unique:taxes',
                'description' => 'max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $tax = $this->tax->addTax($request);
                if ($tax) \Illuminate\Support\Facades\Log::info($user->username . ' has created a tax: ' . $tax->toJson());
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
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->can('tax.update')) {
            $id = intval($request->input('id'));
            $rules = [
                'name' => 'required|max:191|unique:taxes,name,' . $id,
                'description' => 'max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $tax = $this->tax->updateTax($request);
                if ($tax) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a tax: ' . $tax->toJson());
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
        if($user->can('tax.update')) {
            $rules = [
                'id' => 'required',
                'active' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $tax = $this->tax->updateStatusTax($request);
                if ($tax) \Illuminate\Support\Facades\Log::info($user->username . ' has updated status for tax: ' . $tax->toJson());
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
        if($user->can('tax.delete')) {
            $rules = [
                'id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $id = intval($request->input('id'));
                $tax = $this->tax->find($id);
                $tax->delete();
                if ($tax) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted tax: ' . $tax->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return false;
    }
}
