<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\PurchasingRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $user;
    private $role;
    private $permission;
    private $order;
    private $purchasing;
    public function __construct(UserRepository $user, RoleRepository $role, PermissionRepository $permission, OrderRepository $order, PurchasingRepository $purchasing)
    {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
        $this->order = $order;
        $this->purchasing = $purchasing;
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
        $id = cleanNumber($id);
        if ($user->can('user.read') || $user->id === $id) {
            $data['user'] = $userDetail = $this->user->filters([
                'id' => $id,
                'relations' => ['roles', 'permissions'],
                'addSelect' => ['phone'],
            ]);
            $data['roles'] = $this->role->filters();
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
        $id = cleanNumber($request->input('id'));
        if ($user->can('user.read') || $user->id === $id) {
            $data['user'] = $userDetail = $this->user->filters([
                'id' => $id,
                'relations' => ['roles', 'permissions'],
                'addSelect' => ['phone'],
            ]);
            $orders = $this->order->filters([
                'relations' => [],
                'userId' => $id,
                'orderBy' => 'date',
            ]);
            $data['orders'] = $orders;
            $data['permissionIds'] = !empty($userDetail->permissions) ? $userDetail->permissions->pluck('id')->toArray() : [];
            $data['htmlPermissionTable'] = view('users.permissions_table', $data)->render();
            $data['htmlOrderTable'] = view('users.order_table', $data)->render();
            $data['htmlInforTable'] = view('users.user_infor_table', $data)->render();
            return $this->iRespond(true, "", $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getPurchasingData(Request $request)
    {
        $user = Auth::user();
        $id = cleanNumber($request->input('id'));
        if ($user->can('user.read') || $user->id === $id) {
            $purchasing = $this->purchasing->filters([
                'relations' => [],
                'userId' => $id,
                'orderBy' => 'date',
            ]);
            $data['purchasing'] = $purchasing;
            $data['htmlPurchasingTable'] = view('users.purchasing_table', $data)->render();
            return $this->iRespond(true, "", $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function assignPermissions(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user_detail.assign_permission')) {
            DB::connection()->beginTransaction();
            try {
                $id = cleanNumber($request->input('id'));
                $userAssign = $this->user->find($id);
                $permissionIds = cleanNumber($request->input('permissions'));
                $permissionIds = !empty($permissionIds) ? $permissionIds : [];
                $assign = $userAssign->syncPermissions($permissionIds);
                if (isset($assign)) \Illuminate\Support\Facades\Log::info($user->username . ' has assigned permissions for user: ' . $assign->toJson());
                DB::connection()->commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, "");
        }
        return response()->view('errors.404', [], 404);
    }

    public function revokePermissions(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user_detail.assign_permission')) {
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

    public function changePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $id = cleanNumber($request->input('id'));
        if ($user->can('user_detail.change_password') || $user->id === $id) {
            try {
                $userChange = $this->user->find($id);
                $newPassword = $request->input('newPassword');
                $isChange = $userChange->update([
                    'password' => Hash::make($newPassword),
                ]);
                if (isset($isChange)) \Illuminate\Support\Facades\Log::info($user->username . ' has changed password of user: ' . $userChange->toJson());
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, "");
        }
        return response()->view('errors.404', [], 404);
    }

    public function assignRoles(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user_detail.assign_role')) {
            DB::connection()->beginTransaction();
            try {
                $id = cleanNumber($request->input('id'));
                $userAssign = $this->user->find($id);
                $roleIds = cleanNumber($request->input('roles'));
                $roleIds = !empty($roleIds) ? $roleIds : [];
                $roles = $this->role->filters([
                    'roleIds' => $roleIds,
                ]);
                $assign = $userAssign->syncRoles($roles);
                if (isset($assign)) \Illuminate\Support\Facades\Log::info($user->username . ' has assigned roles for user: ' . $assign->toJson());
                DB::connection()->commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, "");
        }
        return response()->view('errors.404', [], 404);
    }

    public function updateInfor(Request $request)
    {
        $user = Auth::user();
        $id = cleanNumber($request->input('id'));
        if ($user->can('user.update') || $user->id === $id) {
            DB::connection()->beginTransaction();
            try {
                $rules = [
                    'fullname' => 'required|string|regex:/^[\pL\s\.\-]+$/u|max:191',
                    'phone' => 'max:40|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|nullable',
                    'email' => 'email|nullable',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
                }
                $userUpdate = $this->user->find($id);
                $isUpdate = $this->user->updateInfor($request);
                if (empty($isUpdate)) {
                    return $this->iRespond(false, 'error');
                }
                \Illuminate\Support\Facades\Log::info($user->username . ' has updated information for user: ' . $userUpdate->toJson());
                DB::connection()->commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
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
