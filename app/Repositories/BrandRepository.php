<?php 
namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\Session;

class BrandRepository extends Repository
{
    public function getModel(): string
    {
        return Brand::class;
    }

    public function getBrands($request)
    {
        $brands = $this->model->select('id', 'name', 'thumb', 'active', 'user_add', 'created_at');
        $status = intval($request->input('status'));
        if ($status !== 10) {
            $brands = $this->model->where('active', $status);
        }
        $brands = $brands->get()->keyBy('id');
        return $brands;
    }

    public function addBrand($request)
    {
        $brand = $this->model->create([
            'name' => trim($request->input('name')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $brand;
    }

    public function updateBrand($request)
    {
        $id = intval($request->input('id'));
        $brand = $this->model->find($id);
        $isUpdate = $brand->update([
            'name' => trim($request->input('name')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $brand;
    }
}