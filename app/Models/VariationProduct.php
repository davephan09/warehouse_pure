<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationProduct extends Model
{
    use HasFactory;
    protected $table = 'variation_products';
    public $timestamps = true;
    protected $fillable = ['product_id', 'name', 'options', 'quantity', 'price', 'sku'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
