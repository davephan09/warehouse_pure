<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $table = 'variations';
    public $timestamps = true;
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_has_variations', 'product_id', 'variation_id')->withPivot('value');
    }
}
