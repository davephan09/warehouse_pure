<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingDiscount extends Model
{
    use HasFactory;
    protected $table = 'purchasing_discounts';
    public $timestamps = true;
    protected $fillable = ['purchasing_id', 'discount_unit', 'discount_value', 'total'];

}
