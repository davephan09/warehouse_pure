<?php 
namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository extends Repository
{
    public function getModel(): string
    {
        return Supplier::class;
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();
        if (!empty($filters['province'])) {
            $query = $query->where('province', $filters['province']);
        }
        if (!empty($filters['status']) && !($filters['status'] === 'all')) {
            $status = intval($filters['status']);
            $query = $query->where('active', $status);
        }
        return $query->get()->keyBy('id');
    }
}