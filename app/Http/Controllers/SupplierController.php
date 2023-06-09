<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Libraries\Address;
use App\Libraries\Bank;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

class SupplierController extends Controller
{
    private $supplier;
    public function __construct(SupplierRepository $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('supplier.read')) {
            $addressApi = new Address();
            $address = $addressApi->getAddress();
            $data['address'] = $address;
            $bankApi = new Bank();
            $banks = $bankApi->getBanks();
            $data['banks'] = collect($banks)->keyBy('code')->toArray();
            $data['title'] = trans('common.supplier_list');
            return view('suppliers.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $status = cleanInput($request->input('status'));
        $provinceInput = intval(cleanInput($request->input('province')));
        $data = array();
        $address = Helper::getDetailAddress();
        $suppliers = $this->supplier->filters([
            'status' => $status,
            'province' => $provinceInput,
        ]);
        $bankApi = new Bank();
        $banks = $bankApi->getBanks();
        $data['suppliers'] = $suppliers->keyBy('id');
        $data['banks'] = collect($banks)->keyBy('code')->toArray();
        $data['address'] = $address;
        $data['htmlSupplierTable'] = view('suppliers.supplier_table', $data)->render();
        return $this->iRespond(true, '', $data);
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
     *
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->can('supplier.create')) {
            $rules = [
                'name' => 'required|string|max:255|min:3|unique:suppliers',
                'phone' => 'max:40|string|nullable',
                'email' => 'max:40|string|nullable',
                'detail_address' => 'max:255|string|nullable',
                'account_number' => 'max:40|string|nullable',
                'note' => 'string|nullable',
                'province' => 'numeric|nullable',
                'district' => 'numeric|nullable',
                'ward' => 'numeric|nullable',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $request->merge([
                    'user_add' => $user->id,
                    'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN)
                ]);
                $supplier = $this->supplier->create($request->all());
                if ($supplier) \Illuminate\Support\Facades\Log::info($user->username . ' has created a supplier: ' . $supplier->toJson());
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
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->can('supplier.update')) {
            $id = intval($request->input('id'));
            $rules = [
                'name' => 'required|string|max:255|min:3|unique:suppliers,name,' . $id,
                'phone' => 'max:40|string|nullable',
                'email' => 'max:40|string|nullable',
                'detail_address' => 'max:255|string|nullable',
                'account_number' => 'max:40|string|nullable',
                'note' => 'string|nullable',
                'province' => 'numeric|nullable',
                'district' => 'numeric|nullable',
                'ward' => 'numeric|nullable',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $supplier = $this->supplier->find($id);
                $isUpdate = $supplier->update([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'province' => $request->input('province'),
                    'district' => $request->input('district'),
                    'ward' => $request->input('ward'),
                    'detail_address' => $request->input('detail_address'),
                    'bank_code' => $request->input('bank_code'),
                    'account_number' => $request->input('account_number'),
                    'note' => $request->input('note'),
                    'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
                    'user_add' => $user->id,
                ]);
                if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a supplier: ' . $supplier->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }

    public function changeStatus(Request $request)
    {
        $user = Auth::user();
        if ($user->can('supplier.update')) {
            $rules = [
                'id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $id = intval($request->input('id'));
                $active = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
                $supplier = $this->supplier->find($id);
                $isUpdate = $supplier->update(['active' => $active]);
                if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has changed status of a supplier: ' . $supplier->toJson());
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
        if ($user->can('supplier.delete')) {
            try {
                $id = intval($request->input('id'));
                if (isset($id)) {
                    $supplier = $this->supplier->find($id);
                    $isDelete = $supplier->delete();
                }
                if ($isDelete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted a supplier: ' . $supplier->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }
}
