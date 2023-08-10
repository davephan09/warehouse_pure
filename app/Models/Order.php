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
    protected $fillable = ['name', 'date', 'customer_id', 'cost', 'paid', 'debt', 'note', 'status', 'user_add'];

    public function details()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function discount()
    {
        return $this->hasOne(OrderDiscount::class, 'order_id', 'id');
    }
}
