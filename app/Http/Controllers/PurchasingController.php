<?php

namespace App\Http\Controllers;

use App\Enums\NumRowPage;
use App\Events\PurchasingBillCreated;
use App\Helpers\Helper;
use App\Libraries\Address;
use App\Repositories\PurchasingRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\TaxRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Validator;

class PurchasingController extends Controller
{
    private $purchasing;
    private $product;
    private $supplier;
    private $tax;
    public function __construct(PurchasingRepository $purchasing, ProductRepository $product, SupplierRepository $supplier, TaxRepository $tax)
    {
        $this->purchasing = $purchasing;
        $this->product = $product;
        $this->supplier = $supplier;
        $this->tax = $tax;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->can('purchasing.read')) {
            try {
                $fromdate = cleanInput($request->get('fromdate'));
                $todate = cleanInput($request->get('todate'));
                $fromdate = \DateTime::createFromFormat('d-m-Y', $fromdate);
                $todate = \DateTime::createFromFormat('d-m-Y', $todate);

                $today = new \DateTime();
                if($todate>$today){
                    $todate = $today;
                }

                if($fromdate === FALSE || $todate === FALSE) {
                    $todate = $today;
                    $fromdate = clone $todate;
                    $fromdate = $fromdate->modify('-7 days');
                }

                $data['title'] = trans('purchasing.list_purchasing_order');
                $data['numRowPage'] = NumRowPage::asSelectArray();
                $data['fromdate'] = $fromdate;
                $data['todate'] = $todate;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return response()->view('errors.404', [], 404);
            }
            return view('purchasing.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('purchasing.read')) {
            try {
                $perPage = cleanNumber($request->get('perPage'));
                $textSearch = cleanInput($request->get('text'));
                $fromdate = cleanInput($request->get('fromdate'));
                $todate = cleanInput($request->get('todate'));
                $fromdate = \DateTime::createFromFormat('d-m-Y', $fromdate);
                $todate = \DateTime::createFromFormat('d-m-Y', $todate);

                $today = new \DateTime();
                if($todate>$today){
                    $todate = $today;
                }

                if($fromdate === FALSE || $todate === FALSE) {
                    $todate = $today;
                    $fromdate = clone $todate;
                    $fromdate = $fromdate->modify('-7 days');
                }

                $bills = $this->purchasing->filters([
                    'fromdate' => $fromdate,
                    'todate' => $todate,
                    'perPage' => $perPage ?? 10,
                    'keyword' => $textSearch,
                ]);

                $data['bills'] = $bills;
                $data['billsData'] = $bills->keyBy('id');
                $data['htmlPurchasingTable'] = view('purchasing.purchasing_table', $data)->render();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user->can('purchasing.create')) {
            try {
                $data['title'] = trans('purchasing.create');
                $address = Helper::getDetailAddress();
                $data['address'] = $address;
                $data['suppliers'] = $this->supplier->filters([
                    'status' => true,
                ]);
                $data['taxes'] = $this->tax->filters([
                    'status' => true,
                ]);
                $data['orderId'] = time();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return response()->view('errors.404', [], 404);
            }
            return view('purchasing.create', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->can('purchasing.create')) {
            DB::connection()->beginTransaction();
            try {
                $rules = [
                    'supplier' => 'required',
                    'date' => 'required',
                    'note' => 'string|nullable',
                    
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $purchasing = $this->purchasing->createPurchasing($request);
                DB::connection()->commit();
                event(new PurchasingBillCreated($purchasing->toArray(), 'create'));
                if ($purchasing) \Illuminate\Support\Facades\Log::info($user->username . ' has created a purchasing bill: ' . $purchasing->toJson());
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
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->can('purchasing.update')) {
            try {
                $id = cleanNumber($id);
                $bill = $this->purchasing->filters([
                    'id' => $id,
                    'relations' => ['details', 'discount', 'details.taxes', 'details.product', 'details.option'],
                ]);
                $data['title'] = trans('purchasing.update');
                $address = Helper::getDetailAddress();
                $data['address'] = $address;
                $data['suppliers'] = $this->supplier->filters([
                    'status' => true,
                ]);
                $data['taxes'] = $this->tax->filters([
                    'status' => true,
                ]);
                $data['bill'] = $bill;
                $productIds = array();
                foreach ($bill->details as $item) {
                    $productIds[$item->option_id] = $item->product_id; 
                };
                $data['productIds'] = $productIds;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return response()->view('errors.404', [], 404);
            }
            return view('purchasing.update', $data);
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
        if ($user->can('purchasing.update')) {
            DB::connection()->beginTransaction();
            try {
                $rules = [
                    'supplier' => 'required',
                    'date' => 'required',
                    'note' => 'string|nullable',
                    
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                list($oldPurchasing, $purchasing) = $this->purchasing->updatePurchasing($request);
                DB::connection()->commit();
                event(new PurchasingBillCreated($purchasing->toArray(), 'update', $oldPurchasing->toArray()));
                if ($purchasing) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a purchasing bill: ' . $purchasing->toJson());
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
        if ($user->can('purchasing.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = cleanNumber($request->input('id'));
                $bill = $this->purchasing->filters([
                    'id' => $id,
                    'relations' => ['details'],
                ]);
                $delete = $bill->delete();
                if ($delete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted a purchasing bill: ' . $bill->toJson());
                DB::connection()->commit();
                event(new PurchasingBillCreated($bill->toArray(), 'delete'));
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
