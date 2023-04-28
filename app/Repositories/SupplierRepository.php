<?php 
namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository extends Repository
{
    public function getModel(): string
    {
        return Supplier::class;
    }

    public function getSuppliers($status, $province)
    {
        $query = $this->model;
        if ($province) {
            $query = $query->where('province', $province);
        }
        if (!($status === 'all')) {
            $status = intval($status);
            $query = $query->where('active', $status);
        }
        return $query->get();
    }
}