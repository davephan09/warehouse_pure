<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingItem extends Model
{
    use HasFactory;
    protected $table = 'purchasing_items';
    public $timestamps = true;
    protected $fillable = ['purchasing_id', 'product_id', 'option_id', 'quantity', 'price', 'discount', 'tax', 'total'];

    public function purchase()
    {
        return $this->belongsTo(Purchasing::class, 'purchasing_id', 'id');
    }
}
