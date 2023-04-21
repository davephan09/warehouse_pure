<?php

namespace App\Http\Controllers;

use App\Enums\DetailedPermission;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private $role;
    private $permission;
    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $listPermission = $this->permission->getAll()->keyBy('name');
        $listPermission = $listPermission->mapToGroups(function ($value, $key) {
            list($entity, $action) = explode('.', $key);
            return [$entity => [$action => $value]];
        });
        foreach($listPermission as $key => $permission) {
            $listPermission[$key] = collect($permission)->mapWithKeys(function ($item) {
                return $item;
            });
        }
        $data['listPermission'] = $listPermission;
        $data['detailedPermission'] = DetailedPermission::asArray();
        
        return view('roles.index', $data);
    }
    
    public function getData(Request $request)
    {
        $data = array();
        $roles = $this->role->getAll();
        $listRoles = $roles->keyBy('id')->mapToGroups(function($item){
            return [$item->id => $item->name];
        })->map(function ($item) {
            return $item[0];
        })->toArray();
        $rolesInfo = $roles->groupBy('id');
        foreach($rolesInfo as $i => $role) {
            $rolesInfo[$i] = collect($role)->mapToGroups(function($item, $key) {
                list($permission, $action) = explode('.', $item->permission_name);
                return [$permission => $action];
            });
        };
        $rolePermission = $roles->groupBy('id')->mapWithKeys(function ($item, $key) {
            return [$key => collect($item)->pluck('permission_id')];
        });
        
        $data['listRoles'] = $listRoles;
        $data['rolesInfo'] = $rolesInfo;
        $data['rolePermission'] = $rolePermission;
        $data['htmlListRoles'] = view('roles.list_role', $data)->render();
        return $this->iRespond(true, "", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        DB::connection()->beginTransaction();
        try {
            $name = trim($request->input('name'));
            $permissionIds = $request->input('permission');
            if ($name && $permissionIds) {
                $role = $this->role->create(['name' => $name]);
                $permissions = $this->permission->getPermissions($permissionIds);
                $role->syncPermissions($permissions);
            }
            DB::connection()->commit();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
            DB::connection()->rollBack();
            return $this->iRespond(false, 'error');
        }
        return $this->iRespond(true, 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roleInfo = $this->role->getRoleInfo($id);
        $permissions = $roleInfo->permissions->mapToGroups(function($item, $key) {
            list($permision, $action) = explode('.', $item->name);
            return [$permision => $action];
        });
        $data['roleInfo'] = $roleInfo;
        $data['permissions'] = $permissions;
        return view('roles.detailed_view', $data);
    }

    public function getDataDetailed(Request $request, $id)
    {
        $data = array();
        $listUsers = $this->role->find($id)->users()->get(['id', 'username', 'first_name', 'last_name', 'email', 'created_at']);
        $data['listUsers'] = $listUsers;
        $data['htmlUserTable'] = view('roles.detailed_user_table', $data)->render();
        return $this->iRespond(true, '', $data);
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
