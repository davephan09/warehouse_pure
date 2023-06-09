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
            $data['title'] = trans('role_permission.permission_list');
            return view('permissions.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $data = array();
        $listPermission = $this->permission->filters();
        $data['listPermission'] = $listPermission->keyBy('id');
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
                    'name' => 'required|string|max:191|unique:permissions',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $name = cleanInput($request->input('name'));
                $isCore = filter_var($request->input('is_core'), FILTER_VALIDATE_BOOLEAN);
                $rs = $this->permission->create([
                    'name' => $name,
                    'is_core' => $isCore
                ]);
                if ($rs) {
                    \Illuminate\Support\Facades\Log::info($user->username . ' has created a permission: ' . $rs->toJson());
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
            $id = intval(cleanInput($request->input('id')));
            $rules = [
                'id' => 'required',
                'name' => 'required|string|max:191|unique:permissions,name,' . $id,
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            DB::connection()->beginTransaction();
            try {
                $name = cleanInput($request->input('name'));
                $permission = $this->permission->find($id);
                $isUpdate = $permission->update(['name' => $name]);
                if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a permission: ' . $permission->toJson());
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
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->can('permission.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = intval(cleanInput($request->input('id')));
                if (isset($id)) {
                    $permission = $this->permission->find($id);
                    $isDelete = $permission->delete();
                    $permission->syncPermissions([]);
                    if ($isDelete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted a permission: ' . $permission->toJson());
                }
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
}
