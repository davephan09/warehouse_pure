<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name', 'product_code', 'category_id', 'quantity', 'summary', 'description', 'active', 'user_add'];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'id', 'category_id');
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'product_has_variations', 'product_id', 'variation_id')->withPivot('value');
    }
}
