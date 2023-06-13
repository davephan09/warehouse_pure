<?php 
namespace App\Repositories;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Tax;
use App\Models\Variation;
use App\Models\VariationProduct;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductRepository extends Repository
{
    public function getModel(): string
    {
        return Product::class;
    }

    public function addProduct($request)
    {
        $variations = $request->input('variations');
        $quantity = 0;
        foreach($variations as $item) {
            if ($item['options']) {
                $quantity += intval($item['quantity']);
            } else {
                $quantity = intval($item['quantity']);
            }
        }
        $product = $this->model->create([
            'product_name' => trim($request->input('product_name')),
            'summary' => trim($request->input('summary')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'brand_id' => intval($request->input('brand_id')),
            'unit_id' => intval($request->input('unit_id')),
            'category_id' => intval($request->input('category_id')),
            'quantity' => $quantity,
            'user_add' => Auth::user()->id,
        ]);
        return $product;
    }

    public function addTag($product, $tags)
    {
        if(!empty($tags)) {
            $product->tags()->detach();
            $product->tags()->attach($tags);
        }
    }

    public function addVariation($product , $variations, $varValues)
    {
        $product->variations()->detach();
        foreach ($variations as $key => $item) {
            $item = intval($item);
            $variation = Variation::find($item);
            $product->variations()->attach($variation, ['value' => $varValues[$key]]);
        }
    }

    public function addTaxProduct($product , $taxIds, $taxValues)
    {
        $product->taxes()->detach();
        foreach ($taxIds as $key => $item) {
            $item = intval($item);
            $tax = Tax::find($item);
            $product->taxes()->attach($tax, ['value' => intval($taxValues[$key])]);
        }
    }

    public function getProducts()
    {
        return $this->model->with('category')->get();
    }

    public function getProduct($id)
    {
        $product = $this->model->with(['category', 'tags', 'taxes', 'variations'])->where('id', $id)->first();
        return $product;
        // $variation = DB::table('product_has_variations')->where('product_id', $id)->get(['variation_id', 'value']);
        // $varValue = $variation->keyBy('variation_id')->toArray();
        // $varIds = $variation->pluck('variation_id');
        // $product = $this->model->with('variations')->with('category')->with('tags')->where('id', $id);
        // if ($variation->isNotEmpty()) {        
        //     $product = $product->whereHas('variations', function($query) use ($varIds) {
        //         $query->whereIn('id', $varIds);
        //     });
        // }
        // $product = $product->first();
        // return [$product, $varValue];
    }

    public function updateProduct($request, $product)
    {
        return $product->update([
            'product_name' => trim($request->input('product_name')),
            'summary' => trim($request->input('summary')),
            'description' => trim($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'category_id' => intval($request->input('category_id')),
            'product_code' => trim($request->input('product_code')),
            'quantity' => intval($request->input('quantity')),
            'user_add' => Auth::user()->id,
        ]);
    }

    public function deleteProduct($id)
    {
        $product = $this->model->find($id);
        $product->delete();
        $product->variations()->detach();
        return $product;
    }

    public function createTag($name)
    {
        return Tag::create(['name' => $name]);
    }

    public function addVariationProduct($product, $variations)
    {
        foreach($variations as $item) {
            if ($item['options']) {
                $options = json_decode($item['options']);
                $options = array_map('intval', $options);
                $options = json_encode($options);
            }
            VariationProduct::create([
                'product_id' => intval($product->id),
                'options' => $options ?? null,
                'name' => trim(strip_tags(stripslashes($item['variationName']))),
                'quantity' => intval($item['quantity']),
                'price' => intval($item['price']),
                'sku' => trim(strip_tags(stripslashes($item['code']))),
            ]);
        }
    }
}