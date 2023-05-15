<?php 
namespace App\Repositories;

use App\Models\Product;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;

class ProductRepository extends Repository
{
    public function getModel(): string
    {
        return Product::class;
    }

    public function addProduct($request)
    {
        $product = $this->model->create([
            'product_name' => trim($request->input('product_name')),
            'summary' => trim($request->input('summary')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'catId' => intval($request->input('category_id')),
            'product_code' => trim($request->input('product_code')),
            'quantity' => intval($request->input('quantity')),
            'user_add' => Auth::user()->id,
        ]);
        return $product;
    }

    public function addVariation($product , $variations, $varValues)
    {
        foreach ($variations as $key => $item) {
            $item = intval($item);
            $variation = Variation::find($item);
            $product->variations()->attach($variation, ['value' => $varValues[$key]]);
        }
    }
}