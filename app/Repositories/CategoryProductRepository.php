<?php 
namespace App\Repositories;

use App\Models\CategoryProduct;

class CategoryProductRepository extends Repository
{
    public function getModel(): string
    {
        return CategoryProduct::class;
    }

    public function getAllActive()
    {
        return $this->model->where('active', 1)->get();
    }
}