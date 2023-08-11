<?php
namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository extends Repository
{
    public function getModel(): string
    {
        return Role::class;
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();
        $query = $query->with('permissions', 'users');

        if(!empty($filters['roleId'])) {
            $data = $query->where('id', $filters['roleId'])->first();
        } else {
            $data = $query->orderBy('id')->get();
        }
        return $data;
    }
}