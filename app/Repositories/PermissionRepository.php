<?php
namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository extends Repository
{
    public function getModel(): string
    {
        return Permission::class;
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();
        $query = $query->with('roles');
        if(!empty($filters['permissionIds'])) {
            $query = $query->whereIn('id', $filters['permissionIds']);
        }
        $data = $query->orderByDesc('id')->get();
        return $data;
    }
}