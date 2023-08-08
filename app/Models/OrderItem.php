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
}
