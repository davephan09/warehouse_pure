<?php

namespace App\Http\Controllers;

use App\Enums\NumRowPage;
use App\Events\OrderBillCreated;
use App\Helpers\Helper;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\TaxRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $order;
    private $customer;
    private $tax;
    public function __construct(OrderRepository $order, TaxRepository $tax, CustomerRepository $customer)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->tax = $tax;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->can('order.read')) {
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

                $data['title'] = trans('order.list_order');
                $data['numRowPage'] = NumRowPage::asSelectArray();
                $data['fromdate'] = $fromdate;
                $data['todate'] = $todate;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return response()->view('errors.404', [], 404);
            }
            return view('order.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('order.read')) {
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

                $orders = $this->order->filters([
                    'fromdate' => $fromdate,
                    'todate' => $todate,
                    'perPage' => $perPage ?? 10,
                    'keyword' => $textSearch,
                ]);

                $data['orders'] = $orders;
                $data['ordersData'] = $orders->keyBy('id');
                $data['htmlOrderTable'] = view('order.order_table', $data)->render();
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
     *
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user->can('order.create')) {
            try {
                $data['title'] = trans('order.create');
                $address = Helper::getDetailAddress();
                $data['address'] = $address;
                $data['customers'] = $this->customer->filters([
                    'status' => true,
                ]);
                $recentOrder = $this->order->filters([
                    'date' => date('Y-m-d'),
                ]);
                $numberOrder = $recentOrder->total() + 1;
                $data['orderId'] = 'OS-' . date('Ymd') . '-' .  str_pad($numberOrder, 5, '0', STR_PAD_LEFT);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return response()->view('errors.404', [], 404);
            }
            return view('order.create', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->can('order.create')) {
            DB::connection()->beginTransaction();
            try {
                $rules = [
                    'customer' => 'required',
                    'date' => 'required',
                    'note' => 'string|nullable',
                    
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $order = $this->order->createOrder($request);
                DB::connection()->commit();
                event(new OrderBillCreated($order->toArray(), 'create'));
                if ($order) \Illuminate\Support\Facades\Log::info($user->username . ' has created an order bill: ' . $order->toJson());
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
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user->can('order.update')) {
            try {
                $id = cleanNumber($id);
                $order = $this->order->filters([
                    'id' => $id,
                    'relations' => ['details', 'discount', 'details.taxes', 'details.product', 'details.option'],
                ]);
                $data['title'] = trans('order.update');
                $address = Helper::getDetailAddress();
                $data['address'] = $address;
                $data['customers'] = $this->customer->filters([
                    'status' => true,
                ]);
                $data['order'] = $order;
                $productIds = array();
                foreach ($order->details as $item) {
                    $productIds[$item->option_id] = $item->product_id; 
                };
                $data['productIds'] = $productIds;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return response()->view('errors.404', [], 404);
            }
            return view('order.update', $data);
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
        if ($user->can('order.update')) {
            DB::connection()->beginTransaction();
            try {
                $rules = [
                    'customer' => 'required',
                    'date' => 'required',
                    'note' => 'string|nullable',
                    
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                list($oldOrder, $order) = $this->order->updateOrder($request);
                DB::connection()->commit();
                event(new OrderBillCreated($order->toArray(), 'update', $oldOrder->toArray()));
                if ($order) \Illuminate\Support\Facades\Log::info($user->username . ' has updated an order bill: ' . $order->toJson());
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
     *
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->can('order.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = cleanNumber($request->input('id'));
                $order = $this->order->filters([
                    'id' => $id,
                    'relations' => ['details'],
                ]);
                $delete = $order->delete();
                if ($delete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted an order bill: ' . $order->toJson());
                DB::connection()->commit();
                event(new OrderBillCreated($order->toArray(), 'delete'));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }

    public function restore(Request $request)
    {
        $user = Auth::user();
        if ($user->can('order.delete')) {
            try {
                $id = cleanNumber($request->input('id'));
                if (isset($id)) {
                    $order = $this->order->restore($id);
                }
                if (!$order) {
                    return $this->iRespond(false, 'error');
                }
                \Illuminate\Support\Facades\Log::info($user->username . ' has restored an order: ' . $order->toJson());
                event(new OrderBillCreated($order->toArray(), 'create'));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }
}
