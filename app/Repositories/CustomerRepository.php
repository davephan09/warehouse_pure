<?php 
namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends Repository
{
    public function getModel(): string
    {
        return Customer::class;
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();
        if (!empty($filters['province'])) {
            $query = $query->where('province', $filters['province']);
        }
        if (isset($filters['status']) && !($filters['status'] === 'all')) {
            $status = intval($filters['status']);
            $query = $query->where('active', $status);
        }
        if (!empty($filters['keyword'])) {
            $query = $query->where(function($queryText) use ($filters) {
                $queryText->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($filters['keyword']) . '%'])
                    ->orWhereRaw('LOWER(note) LIKE ?', ['%' . strtolower($filters['keyword']) . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($filters['keyword']) . '%']);
            });
        }
        $query->orderBy('name');
        if (!empty($filters['perPage'])) {
            $query = $query->paginate($filters['perPage']);
            return $query;
        }
        return $query->get()->keyBy('id');
    }
}