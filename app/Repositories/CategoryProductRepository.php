<?php 
namespace App\Repositories;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Session;

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

    public function updateCat($request)
    {
        $user = Session::get('user');
        $id = intval($request->input('id'));
        $category = $this->model->find($id);
        $request->merge([
            'user_add' => $user->id,
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN)
        ]);
        $category->update($request->all());
        return $category;
    }
}