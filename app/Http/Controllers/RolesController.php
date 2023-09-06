<?php

namespace App\Http\Controllers;

use App\Enums\DetailedPermission;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private $role;
    private $permission;
    private $user;
    public function __construct(RoleRepository $role, PermissionRepository $permission, UserRepository $user)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('role.read')) {
            $data = array();
            $listPermission = $this->permission->filters()->keyBy('name');
            $listPermission = $listPermission->mapToGroups(function ($value, $key) {
                list($entity, $action) = explode('.', $key);
                return [$entity => [$action => $value]];
            });
            foreach ($listPermission as $key => $permission) {
                $listPermission[$key] = collect($permission)->mapWithKeys(function ($item) {
                    return $item;
                });
            }
            $data['listPermission'] = $listPermission;
            $data['detailedPermission'] = DetailedPermission::asArray();
            $data['title'] = trans('role_permission.role_list');

            return view('roles.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $data = array();
        $roles = $this->role->filters();
        $listRoles = $roles->keyBy('id')->mapToGroups(function ($item) {
            return [$item->id => $item->name];
        })->map(function ($item) {
            return $item[0];
        })->toArray();
        $rolesInfo = $roles->keyBy('id');
        foreach ($rolesInfo as $i => $role) {
            $rolesInfo[$i] = collect($role->permissions)->mapToGroups(function ($item, $key) {
                list($permission, $action) = explode('.', $item->name);
                return [$permission => $action];
            });
        };
        $rolePermission = $roles->keyBy('id')->mapWithKeys(function ($item, $key) {
            return [$key => collect($item->permissions)->pluck('id')];
        });

        $data['listRoles'] = $listRoles;
        $data['rolesInfo'] = $rolesInfo;
        $data['rolePermission'] = $rolePermission;
        $data['roles'] = $roles->keyBy('id');
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
        $user = Auth::user();
        if ($user->can('role.create')) {
            $rules = [
                'name' => 'required|string|max:191|unique:roles',
                'permission' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            DB::connection()->beginTransaction();
            try {
                $name = cleanInput($request->input('name'));
                $permissionIds = cleanInput($request->input('permission'));
                $role = $this->role->create(['name' => $name]);
                $permissions = $this->permission->filters([
                    'permissionIds' => $permissionIds,
                ]);
                $role->syncPermissions($permissions);
                if ($role) \Illuminate\Support\Facades\Log::info($user->username . ' has created a role: ' . $role->toJson());
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
     */
    public function show($id)
    {
        $user = Auth::user();        
        if ($user->can('role.read')) {
            $roleInfo = $this->role->filters([
                'roleId' => intval(cleanInput($id)),
            ]);
            $permissionRole = $roleInfo->permissions->pluck('id')->toArray();
            $permissions = $roleInfo->permissions->mapToGroups(function ($item, $key) {
                list($permision, $action) = explode('.', $item->name);
                return [$permision => $action];
            });
            $listPermission = $this->permission->filters()->keyBy('name');
            $listPermission = $listPermission->mapToGroups(function ($value, $key) {
                list($entity, $action) = explode('.', $key);
                return [$entity => [$action => $value]];
            });
            foreach ($listPermission as $key => $permission) {
                $listPermission[$key] = collect($permission)->mapWithKeys(function ($item) {
                    return $item;
                });
            }
            $data['title'] = trans('role_permission.role_detail');
            $data['permissionRole'] = $permissionRole;
            $data['listPermission'] = $listPermission;
            $data['roleInfo'] = $roleInfo;
            $data['permissions'] = $permissions;
            return view('roles.detailed_view', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getDataDetailed(Request $request, $id)
    {
        $data = array();
        $listUsers = $this->role->find($id)->users()->get(['id', 'username', 'first_name', 'last_name', 'email', 'avatar', 'created_at']);
        $data['listUsers'] = $listUsers;
        $data['htmlUserTable'] = view('roles.detailed_user_table', $data)->render();
        return $this->iRespond(true, '', $data);
    }

    public function searchUser(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user.read')) {
            try {
                $text = cleanInput($request->input('keyword')['term']);
                $data = $this->user->searchUser($text);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, '', $data);
        }
        return $this->iRespond(false, 'error');
    }

    public function assignUsers(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user_detail.assign_role')) {
            $id = intval(cleanInput($request->input('id')));
            $rules = [
                'roleId' => 'required',
                'userIds' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            DB::connection()->beginTransaction();
            try {
                $roleId = cleanNumber($request->input('roleId'));
                $userIds = cleanNumber($request->input('userIds'));
                $role = $this->role->find($roleId);
                $users = $this->user->filters([
                    'ids' => $userIds,
                ]);
                if (isset($users) && isset($role)) {
                    foreach($users as $userItem) {
                        if (!$userItem->hasRole($role)) {
                            $userItem->assignRole($role);
                        }
                    }
                    \Illuminate\Support\Facades\Log::info($user->username . ' has assigned a user to a role: ' . $role->toJson());
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
        if ($user->can('role.update')) {
            $id = intval(cleanInput($request->input('id')));
            $rules = [
                'id' => 'required',
                'name' => 'required|string|max:191|unique:roles,name,' . $id,
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            DB::connection()->beginTransaction();
            try {
                $name = cleanInput($request->input('name'));
                $permissionIds = cleanInput($request->input('permission'));
                $role = $this->role->find($id);
                if ($permissionIds && $role) {
                    $isUpdate = $role->update(['name' => $name]);
                    $permissions = $this->permission->filters([
                        'permissionIds' => $permissionIds,
                    ]);
                    $role->syncPermissions($permissions);
                    if ($isUpdate) \Illuminate\Support\Facades\Log::info($user->username . ' has updated a role: ' . $role->toJson());
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

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if($user->can('role.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = intval($request->input('id'));
                if (isset($id)) {
                    $role = $this->role->find($id);
                    $isDelete = $role->delete();
                    $role->syncPermissions([]);
                    if ($isDelete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted a role: ' . $role->toJson());
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
