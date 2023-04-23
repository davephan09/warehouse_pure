<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    private $permission;

    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('permission.read')) {
            $data = array();
            return view('permissions.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $data = array();
        $listPermission = $this->permission->getAll()->keyBy('id');
        $data['listPermission'] = $listPermission;
        // $data['listPermission'] = $listPermission = $this->permission->getPermissionList();
        $data['htmlPermissionTable'] = view('permissions.permission_table', $data)->render();

        return $this->iRespond(true, '', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->can('permission.create')) {
            try {
                $rules = [
                    'name' => 'required|max:191',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $name = trim($request->input('name'));
                $isCore = filter_var($request->input('is_core'), FILTER_VALIDATE_BOOLEAN);
                $rs = $this->permission->create([
                    'name' => $name,
                    'is_core' => $isCore
                ]);
                if (!$rs) {
                    return $this->iRespond(false, 'error');
                }
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
        if ($user->can('permission.update')) {
            $rules = [
                'id' => 'required',
                'name' => 'required|max:191',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            DB::connection()->beginTransaction();
            try {
                $id = intval($request->input('id'));
                $name = trim($request->input('name'));
                $role = $this->permission->find($id);
                $role->update(['name' => $name]);
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
