<?php
namespace App\Repositories;

use App\Models\Variation;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Session;

class VariationRepository extends Repository
{
    public function getModel(): string
    {
        return Variation::class;
    }

    public function addVariation($request)
    {
        $user = Session::get('user');
        $variation = $this->model->create([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => $user->id,
        ]);
        $options = $request->input('options');
        if ($options && $variation) {
            foreach ($options as $option) {
                VariationOption::create([
                    'variation_id' => $variation->id,
                    'name' => $option,
                ]);
            }
        }
        return $variation;
    }
}