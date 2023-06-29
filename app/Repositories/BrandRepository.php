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

    public function filters($filters = [])
    {
        $query = $this->model->query();
        $query = $query->select('id', 'name', 'thumb', 'active', 'user_add', 'created_at');

        if(isset($filters['status']) && !($filters['status'] === 10)) {
            $data = $query->where('active', $filters['status']);
        }
        
        $data = $query->orderBy('name')->get()->keyBy('id');
        return $data;
    }

    public function addBrand($request)
    {
        $brand = $this->model->create([
            'name' => cleanInput($request->input('name')),
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
            'name' => cleanInput($request->input('name')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $brand;
    }

    public function updateStatusBrand($request)
    {
        $id = intval(cleanInput($request->input('id')));
        $brand = $this->model->find($id);
        $isUpdate = $brand->update([
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $brand;
    }
}