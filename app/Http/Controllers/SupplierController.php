<?php

namespace App\Http\Controllers;

use App\Libraries\Address;
use App\Libraries\Bank;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    private $supplier;
    public function __construct(SupplierRepository $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $status = trim($request->input('status'));
        $provinceInput = intval($request->input('province'));
        $data = array();
        $addressApi = new Address();
        $address = $addressApi->getAddress();
        $address = collect($address)->keyBy('code')->map(function($province) {
            $province->districts = collect($province->districts)->keyBy('code')->map(function($district) {
                $district->wards = collect($district->wards)->keyBy('code');
                return $district;
            });
            return $province;
        });
        $suppliers = $this->supplier->getSuppliers($status, $provinceInput)->keyBy('id');
        $bankApi = new Bank();
        $banks = $bankApi->getBanks();
        $data['suppliers'] = $suppliers;
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
                'name' => 'required|max:255|min:3|unique:suppliers',
                'phone' => 'max:40',
                'email' => 'max:40',
                'detail_address' => 'max:255',
                'account_number' => 'max:40',
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
                $this->supplier->create($request->all());
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
            $rules = [
                'name' => 'required|max:255|min:3',
                'phone' => 'max:40',
                'email' => 'max:40',
                'detail_address' => 'max:255',
                'account_number' => 'max:40',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $id = intval($request->input('id'));
                $supplier = $this->supplier->find($id);
                $supplier->update([
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
                $this->supplier->find($id)->update(['active' => $active]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
