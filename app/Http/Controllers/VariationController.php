<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Repositories\VariationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class VariationController extends Controller
{
    private $variation;
    public function __construct (VariationRepository $variation)
    {
        $this->variation = $variation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('variation.read')) {
            $data['title'] = trans('common.variations');
            $data['listStatus'] = ActiveStatus::asSelectArray();
            return view('variation.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('variation.read')) {
            $variations = $this->variation->getVariations($request);
            $data['variations'] = $variations;
            $data['htmlVariationTable'] = view('variation.variation_table', $data)->render();
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
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->can('variation.create')) {
            $rules = [
                'name' => 'required|max:255|min:1|unique:variations',
                'description' => 'max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            DB::connection()->beginTransaction();
            try {
                $variation = $this->variation->addVariation($request);
                if ($variation) \Illuminate\Support\Facades\Log::info($user->username . ' has created a variation: ' . $variation->toJson());
                DB::connection()->commit();
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
        if($user->can('variation.update')) {
            $id = intval($request->input('id'));
            $rules = [
                'name' => 'required|max:191|unique:variations,name,' . $id,
                'description' => 'max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            DB::connection()->beginTransaction();
            try {
                $variation = $this->variation->updateVariation($request);
                $isUpdate = $this->variation->updateVarOptions($request);
                if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a variation: ' . $variation->toJson());
                DB::connection()->commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return false;
    }

    public function updateStatus(Request $request)
    {
        $user = Auth::user();
        if($user->can('variation.update')) {
            $rules = [
                'id' => 'required',
                'active' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $variation = $this->variation->updateStatusVariation($request);
                if ($variation) \Illuminate\Support\Facades\Log::info($user->username . ' has updated status for variation: ' . $variation->toJson());
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
