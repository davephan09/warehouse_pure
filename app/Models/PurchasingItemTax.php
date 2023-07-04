<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingItemTax extends Model
{
    use HasFactory;
    protected $table = 'purchasing_item_taxes';
    public $timestamps = false;
    protected $fillable = ['item_id', 'tax_id', 'percent', 'value'];
}
