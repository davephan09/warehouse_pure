<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, 
        SoftDeletes;
    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = ['order_name', 'date', 'customer_id', 'cost', 'paid', 'debt', 'note', 'status', 'user_add'];

}
