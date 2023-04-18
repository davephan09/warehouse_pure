<?php
namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository extends Repository
{
    public function getModel(): string
    {
        return Permission::class;
    }

    public function getPermissionList()
    {
        $permissionList = $this->model->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
                    ->get(['permissions.*', 'roles.name as role_name', 'roles.id as role_id']);
        return $permissionList;
    }

    public function getPermissions($permissionIds)
    {
        $permissions = $this->model->whereIn('id', $permissionIds)->get();
        return $permissions;
    }
}