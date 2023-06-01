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

    public function getTaxes($request)
    {
        $taxes = $this->model->select('id', 'name', 'description', 'active', 'user_add', 'created_at');
        $status = intval($request->input('status'));
        if ($status !== 10) {
            $taxes = $this->model->where('active', $status);
        }
        $taxes = $taxes->get()->keyBy('id');
        return $taxes;
    }

    public function addTax($request)
    {
        $tax = $this->model->create([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $tax;
    }

    public function updateTax($request)
    {
        $id = intval($request->input('id'));
        $tax = $this->model->find($id);
        $isUpdate = $tax->update([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $tax;
    }

    public function updateStatusTax($request)
    {
        $id = intval($request->input('id'));
        $tax = $this->model->find($id);
        $isUpdate = $tax->update([
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => Session::get('user')->id,
        ]);
        return $tax;
    }

    public function getActiveTaxes()
    {
        return $this->model->select('id', 'name', 'description')->where('active', 1)->orderBy('name', 'asc')->get();
    }
}