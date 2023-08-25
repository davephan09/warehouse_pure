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
            if (isset($item['options'])) {
                $quantity += cleanNumber($item['quantity']);
            } else {
                $quantity = cleanNumber($item['quantity']);
            }
        }
        $product = $this->model->create([
            'product_name' => cleanInput($request->input('product_name')),
            'summary' => cleanInput($request->input('summary')),
            'description' => cleanInput($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'brand_id' => cleanNumber($request->input('brand_id')),
            'unit_id' => cleanNumber($request->input('unit_id')),
            'category_id' => cleanNumber($request->input('category_id')),
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

    // public function addVariation($product , $variations, $varValues)
    // {
    //     $product->variations()->detach();
    //     foreach ($variations as $key => $item) {
    //         $item = intval($item);
    //         $variation = Variation::find($item);
    //         $product->variations()->attach($variation, ['value' => $varValues[$key]]);
    //     }
    // }

    public function addTaxProduct($product , $taxIds, $taxValues)
    {
        $product->taxes()->detach();
        foreach ($taxIds as $key => $item) {
            $item = intval($item);
            $tax = Tax::find($item);
            $product->taxes()->attach($tax, ['value' => intval($taxValues[$key])]);
        }
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();

        if(!empty($filters['relations'])) {
            $query = $query->with($filters['relations']);
        }
        
        if(!empty($filters['productIds'])) {
            $query = $query->whereIn('id', $filters['productIds']);
        }

        if(isset($filters['status']) && !($filters['status'] === 10)) {
            $status = $filters['status'];
            $query = $query->where('active', $status);
        }

        if(!empty($filters['productId'])) {
            $query = $query->where('id', $filters['productId']);
            $data = $query->first();
        } else {
            if(!empty(($filters['perPage']))) {
                $data = $query->orderByDesc('id')->paginate($filters['perPage']);
            } else {
                $data = $query->orderByDesc('id')->get();
            }
        }
        return $data;
    }
    
    public function updateProduct($request, $product)
    {
        $variations = $request->input('variations');
        $quantity = 0;
        foreach($variations as $item) {
            if (isset($item['options'])) {
                $quantity += cleanNumber($item['quantity']);
            } else {
                $quantity = cleanNumber($item['quantity']);
            }
        }
        return $product->update([
            'product_name' => cleanInput($request->input('product_name')),
            'summary' => cleanInput($request->input('summary')),
            'description' => cleanInput($request->input('description')),
            'active' => filter_var($request->active, FILTER_VALIDATE_BOOLEAN),
            'category_id' => cleanNumber($request->input('category_id')),
            'quantity' => $quantity,
            'brand_id' => cleanNumber($request->input('brand_id')),
            'unit_id' => cleanNumber($request->input('unit_id')),
            'user_add' => Auth::user()->id,
        ]);
    }

    public function deleteProduct($id)
    {
        $product = $this->model->find($id);
        $product->delete();
        $product->taxes()->detach();
        $product->tags()->detach();
        VariationProduct::where('product_id', $id)->delete();
        return $product;
    }

    public function createTag($name)
    {
        return Tag::create(['name' => $name]);
    }

    public function addVariationProduct($product, $variations)
    {
        foreach($variations as $item) {
            if (isset($item['options'])) {
                $options = json_decode($item['options']);
                $options = array_map('intval', $options);
                $options = json_encode($options);
            }
            VariationProduct::create([
                'product_id' => cleanNumber($product->id),
                'options' => $options ?? null,
                'name' => trim(strip_tags(stripslashes($item['variationName']))),
                'quantity' => cleanNumber($item['quantity']),
                'price' => cleanNumber($item['price']),
                'sku' => trim(strip_tags(stripslashes($item['code']))),
            ]);
        }
    }

    public function updateVariationProduct($product, $variations)
    {
        foreach ($variations as $item) {
            if (isset($item['options'])) {
                $options = json_decode($item['options']);
                $options = cleanNumber($options);
                $options = json_encode($options);
            }
            VariationProduct::updateOrCreate(
                [
                    'product_id' => cleanNumber($product->id),
                    'options' => $options ?? null,
                ],
                [
                    'product_id' => cleanNumber($product->id),
                    'options' => $options ?? null,
                    'name' => trim(strip_tags(stripslashes($item['variationName']))),
                    'quantity' => cleanNumber($item['quantity']),
                    'price' => cleanNumber($item['price']),
                    'sku' => trim(strip_tags(stripslashes($item['code']))),
                ]
            );
        }
    }

    public function deleteVariationProduct($product)
    {
        VariationProduct::where('product_id', $product->id)->delete();
    }

    public function searchProduct($text)
    {
        return $this->model->select('id', 'product_name', 'category_id', 'thumb', 'summary')->with('category')->with('variations')
            ->where('active', true)
            ->where(function($query) use($text) {
                $query->whereRaw('LOWER(product_name) LIKE ?', ['%' . strtolower($text) . '%'])
                    ->orWhereHas('category', function($query) use ($text) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($text) . '%']);    
                    });
            })
            ->get();
    }

    public function variationFilters($filters = [])
    {
        $query = VariationProduct::query();

        if(!empty($filters['relations'])) {
            $query = $query->with($filters['relations']);
        }

        if(!empty($filters['ids'])) {
            $query->whereIn('id', $filters['ids']);
        }

        $data = $query->orderByDesc('id')->get();
        return $data;
    }
}