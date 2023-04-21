<?php
namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository extends Repository
{
    public function getModel(): string
    {
        return Role::class;
    }

    public function getAll()
    {
        $listRole = $this->model->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
                                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                                ->get(['roles.*', 'permissions.name as permission_name', 'permissions.id as permission_id']);
        return $listRole;
    }

    public function getRoleInfo($id)
    {
        $role = $this->model->with('permissions')->where('id', $id)->first();
        return $role;
    }
}