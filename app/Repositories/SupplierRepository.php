<?php 
namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository extends Repository
{
    public function getModel(): string
    {
        return Supplier::class;
    }

}