<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    private $user;
    private $role;
    private $permission;
    public function __construct(UserRepository $user, RoleRepository $role, PermissionRepository $permission)
    {
        $this->user = $user;
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
        $user = Auth::user();
        if ($user->can('user.read')) {
            $roles = $this->role->getAll();
            $roles = $roles->keyBy('id');
            $data['roles'] = $roles;
            $data['title'] = trans('role_permission.user_list');
            return view('users.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $roleId = cleanNumber($request->input('roleId'));
        $keyword = cleanInput($request->input('text'));
        $data = array();
        $users = $this->user->filters([
            'roleIds' => !empty($roleId) ? [$roleId] : [],
            'keyword' => $keyword,
            'perPage' => 10
        ]);
        $data['users'] = $users;
        $data['htmlUserTable'] = view('users.user_table', $data)->render();
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
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user->can('user.update')) {
            $id = cleanNumber($id);
            $data['user'] = $userDetail = $this->user->filters([
                'id' => $id,
                'relations' => ['roles', 'permissions'],
            ]);
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
            $data['title'] = trans('user.user_detail');
            return view('users.show', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getDetailData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user.update')) {
            $id = cleanNumber($request->input('id'));
            $data['user'] = $userDetail = $this->user->filters([
                'id' => $id,
                'relations' => ['roles', 'permissions'],
            ]);
            $data['permissionIds'] = !empty($userDetail->permissions) ? $userDetail->permissions->pluck('id')->toArray() : [];
            $data['htmlPermissionTable'] = view('users.permissions_table', $data)->render();
            return $this->iRespond(true, "", $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function assignPermissions(Request $request)
    {
        $user = Auth::user();
        if ($user->can('permission.update')) {
            try {
                $id = cleanNumber($request->input('id'));
                $userAssign = $this->user->find($id);
                $permissionIds = cleanNumber($request->input('permissions'));
                $permissionIds = !empty($permissionIds) ? $permissionIds : [];
                $assign = $userAssign->syncPermissions($permissionIds);
                if (isset($assign)) \Illuminate\Support\Facades\Log::info($user->username . ' has assigned permissions for user: ' . $assign->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, "");
        }
        return response()->view('errors.404', [], 404);
    }

    public function revokePermissions(Request $request)
    {
        $user = Auth::user();
        if ($user->can('permission.update')) {
            try {
                $id = cleanNumber($request->input('id'));
                $userRevoke = $this->user->find($id);
                $permissionId = cleanNumber($request->input('permission'));
                $permissionId = !empty($permissionId) ? $permissionId : '';
                $revoke = $userRevoke->revokePermissionTo($permissionId);
                if (isset($revoke)) \Illuminate\Support\Facades\Log::info($user->username . ' has revoked permissions of user: ' . $revoke->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, "");
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
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = cleanNumber($request->input('id'));
                $userDelete = $this->user->filters([
                    'id' => $id,
                ]);
                $userDelete->roles()->detach();
                $userDelete->permissions()->detach();
                $delete = $userDelete->delete();
                if ($delete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted a user: ' . $userDelete->toJson());
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
