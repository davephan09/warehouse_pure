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

    public function getUnits($request)
    {
        $units = $this->model->select('id', 'name', 'description', 'active', 'user_add', 'created_at');
        $status = intval($request->input('status'));
        if ($status !== 10) {
            $units = $this->model->where('active', $status);
        }
        $units = $units->get()->keyBy('id');
        return $units;
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