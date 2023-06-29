<?php
namespace App\Repositories;

use App\Models\Tax;
use Illuminate\Support\Facades\Session;

class TaxRepository extends Repository
{
    public function getModel(): string
    {
        return Tax::class;
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();
        $query = $query->select('id', 'name', 'description', 'active', 'user_add', 'created_at');
        
        if (isset($filters['status']) && !($filters['status'] === 10)) {
            $status = intval($filters['status']);
            $query = $query->where('active', $status);
        }
        $data = $query->orderBy('name', 'asc')->get()->keyBy('id');
        return $data;
    }

    public function addTax($request)
    {
        $tax = $this->model->create([
            'name' => cleanInput($request->input('name')),
            'description' => cleanInput($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $tax;
    }

    public function updateTax($request)
    {
        $id = intval(cleanInput($request->input('id')));
        $tax = $this->model->find($id);
        $isUpdate = $tax->update([
            'name' => cleanInput($request->input('name')),
            'description' => cleanInput($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $tax;
    }

    public function updateStatusTax($request)
    {
        $id = intval(cleanInput($request->input('id')));
        $tax = $this->model->find($id);
        $isUpdate = $tax->update([
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $tax;
    }
}