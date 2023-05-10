<?php 
namespace App\Repositories;

use App\Models\CategoryProduct;

class CategoryProductRepository extends Repository
{
    public function getModel(): string
    {
        return CategoryProduct::class;
    }

}