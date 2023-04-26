<?php

namespace App\Http\Controllers;

use App\Libraries\Address;
use App\Libraries\Bank;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $data['banks'] = $banks;
            $data['title'] = trans('common.supplier_list');
            return view('suppliers.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData()
    {
        $data = array();
        $addressApi = new Address();
        $address = $addressApi->getAddress();
        $address = collect($address)->keyBy('code')->map(function($item) {
            $item->districts = collect($item->districts)->keyBy('code');
            return $item;
        });
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
