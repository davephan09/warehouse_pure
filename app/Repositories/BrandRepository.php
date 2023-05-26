<?php 
namespace App\Repositories;

use App\Models\Brand;

class BrandRepository extends Repository
{
    public function getModel(): string
    {
        return Brand::class;
    }

    public function addBrand($request)
    {
        $brand = $this->model->create([
            'name' => trim($request->input('name')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'thumb' => 'test', 
        ]);
        return $brand;
    }
}