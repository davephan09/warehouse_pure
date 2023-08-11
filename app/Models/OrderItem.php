<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_items';
    public $timestamps = true;
    protected $fillable = ['order_id', 'product_id', 'option_id', 'quantity', 'price', 'discount', 'tax', 'total'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'order_item_taxes', 'item_id', 'tax_id')->withPivot(['percent', 'value']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    public function option()
    {
        return $this->belongsTo(VariationProduct::class, 'option_id', 'id');
    }
}
