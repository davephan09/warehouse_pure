<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name', 'category_id', 'quantity', 'thumb', 'summary', 'description', 'brand_id', 'unit_id', 'tax', 'active', 'user_add'];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_has_tags', 'product_id', 'tag_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'product_has_taxes', 'product_id', 'tax_id')->withPivot('value');
    }

    public function variations()
    {
        return $this->hasMany(VariationProduct::class, 'product_id', 'id');
    }
}
