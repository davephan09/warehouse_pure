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

    public function getVariations($request)
    {
        $status = intval($request->input('status'));
        $variations = $this->model->with('options');
        if($status !== 10) {
            $variations = $variations->where('active', $status);
        }
        $variations = $variations->get()->keyBy('id');
        return $variations;
    }

    public function updateVariation($request)
    {
        $user = Session::get('user');
        $id = intval($request->input('id'));
        $variation = $this->model->find($id);
        $isUpdate = $variation->update([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'user_add' => $user->id,
        ]);
        if ($isUpdate) {
            return $variation;
        }
    }

    public function updateVarOptions($request)
    {
        $id = intval($request->input('id'));
        $optionsKey = $request->input('optionsKey');
        $optionsValue = $request->input('optionsValue');
        $options = array_combine($optionsKey, $optionsValue);
        $diff = array_diff_key($options, array_flip($optionsValue));
        $intersect = array_intersect_key($options, array_flip($optionsValue));
        $varOptions = VariationOption::where('variation_id', $id)->get()->keyBy('id');
        foreach ($varOptions as $item) {
            if (!in_array($item->name, $diff)) {
                $item->delete();
            }
        }
        foreach ($intersect as $item) {
            VariationOption::create([
                'variation_id' => $id,
                'name' => $item,
            ]);
        }
        return true;
    }
}