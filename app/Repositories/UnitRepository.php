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
}