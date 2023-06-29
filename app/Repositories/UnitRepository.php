<?php
namespace App\Repositories;

use App\Models\Unit;
use Illuminate\Support\Facades\Session;

class UnitRepository extends Repository
{
    public function getModel(): string
    {
        return Unit::class;
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

    public function addUnit($request)
    {
        $unit = $this->model->create([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $unit;
    }

    public function updateUnit($request)
    {
        $id = intval($request->input('id'));
        $unit = $this->model->find($id);
        $isUpdate = $unit->update([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $unit;
    }

    public function updateStatusUnit($request)
    {
        $id = intval($request->input('id'));
        $unit = $this->model->find($id);
        $isUpdate = $unit->update([
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $unit;
    }
}