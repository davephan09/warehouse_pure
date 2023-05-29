<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    private $unit;
    public function __construct (UnitRepository $unit)
    {
        $this->unit = $unit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('unit.read')) {
            $data['title'] = trans('common.units');
            $data['listStatus'] = ActiveStatus::asSelectArray();
            return view('unit.index', $data);
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
        if($user->can('unit.create')) {
            $rules = [
                'name' => 'required|max:191|unique:units',
                'description' => 'max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $unit = $this->unit->addUnit($request);
                if ($unit) \Illuminate\Support\Facades\Log::info($user->username . ' has created a unit: ' . $unit->name);
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
