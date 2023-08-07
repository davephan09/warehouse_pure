<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Libraries\Address;
use App\Libraries\Bank;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    private $customer;
    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('customer.read')) {
            $addressApi = new Address();
            $address = $addressApi->getAddress();
            $data['address'] = $address;
            $bankApi = new Bank();
            $banks = $bankApi->getBanks();
            $data['banks'] = collect($banks)->keyBy('code')->toArray();
            $data['title'] = trans('common.customer_list');
            return view('customers.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $status = cleanInput($request->input('status'));
        $provinceInput = intval(cleanInput($request->input('province')));
        $keyword = cleanInput($request->input('text'));
        $data = array();
        $address = Helper::getDetailAddress();
        $customers = $this->customer->filters([
            'status' => $status,
            'province' => $provinceInput,
            'keyword' => $keyword,
            'perPage' => 10,
        ]);
        $bankApi = new Bank();
        $banks = $bankApi->getBanks();
        $data['customers'] = $customers;
        $data['customersMap'] = $customers->keyBy('id');
        $data['banks'] = collect($banks)->keyBy('code')->toArray();
        $data['address'] = $address;
        $data['htmlCustomerTable'] = view('customers.customer_table', $data)->render();
        return $this->iRespond(true, '', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->can('customer.create')) {
            $rules = [
                'name' => 'required|string|max:255|min:3|unique:customers',
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
                $requestInput = cleanInput($request->toArray());
                $customer = $this->customer->create($requestInput);
                if ($customer) \Illuminate\Support\Facades\Log::info($user->username . ' has created a customer: ' . $customer->toJson());
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
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->can('customer.update')) {
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
                $requestInput = cleanInput($request->toArray());
                $customer = $this->customer->find($id);
                $isUpdate = $customer->update([
                    'name' => $requestInput['name'],
                    'phone' => $requestInput['phone'],
                    'email' => $requestInput['email'],
                    'province' => $requestInput['province'],
                    'district' => $requestInput['district'],
                    'ward' => $requestInput['ward'],
                    'detail_address' => $requestInput['detail_address'],
                    'bank_code' => $requestInput['bank_code'],
                    'account_number' => $requestInput['account_number'],
                    'note' => $requestInput['note'],
                    'active' => filter_var($requestInput['active'], FILTER_VALIDATE_BOOLEAN),
                    'user_add' => $user->id,
                ]);
                if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a customer: ' . $customer->toJson());
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
        if ($user->can('customer.update')) {
            $rules = [
                'id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $id = cleanNumber($request->input('id'));
                $active = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
                $customer = $this->customer->find($id);
                $isUpdate = $customer->update(['active' => $active]);
                if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has changed status of a customer: ' . $customer->toJson());
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
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->can('customer.delete')) {
            try {
                $id = intval($request->input('id'));
                if (isset($id)) {
                    $customer = $this->customer->find($id);
                    $isDelete = $customer->delete();
                }
                if ($isDelete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted a customer: ' . $customer->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }

    public function restore(Request $request)
    {
        $user = Auth::user();
        if ($user->can('customer.delete')) {
            try {
                $id = cleanNumber($request->input('id'));
                if (isset($id)) {
                    $customer = $this->customer->restore($id);
                }
                if ($customer) \Illuminate\Support\Facades\Log::info($user->username . ' has restored a customer: ' . $customer->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }
}
