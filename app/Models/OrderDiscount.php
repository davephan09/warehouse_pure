<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDiscount extends Model
{
    use HasFactory;
    protected $table = 'order_discounts';
    public $timestamps = true;
    protected $fillable = ['order_id', 'discount_unit', 'discount_value', 'total'];
}