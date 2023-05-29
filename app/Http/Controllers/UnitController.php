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

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('unit.read')) {
            $data['units'] = $this->unit->getUnits($request);
            $data['htmlUnitTable'] = view('unit.unit_table', $data)->render();
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
                if ($unit) \Illuminate\Support\Facades\Log::info($user->username . ' has created a unit: ' . $unit->toJson());
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
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->can('unit.update')) {
            $id = intval($request->input('id'));
            $rules = [
                'name' => 'required|max:191|unique:units,name,' . $id,
                'description' => 'max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $unit = $this->unit->updateUnit($request);
                if ($unit) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a unit: ' . $unit->toJson());
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
        if($user->can('unit.update')) {
            $rules = [
                'id' => 'required',
                'active' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $unit = $this->unit->updateStatusUnit($request);
                if ($unit) \Illuminate\Support\Facades\Log::info($user->username . ' has updated status for unit: ' . $unit->toJson());
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
        if($user->can('unit.delete')) {
            $rules = [
                'id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $id = intval($request->input('id'));
                $unit = $this->unit->find($id);
                $unit->delete();
                if ($unit) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted unit: ' . $unit->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return false;
    }
}
