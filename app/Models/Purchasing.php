<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchasing extends Model
{
    use HasFactory, 
        SoftDeletes;
    protected $table = 'purchasings';
    public $timestamps = true;
    protected $fillable = ['purchasing_name', 'date', 'supplier_id', 'cost', 'paid', 'debt', 'note', 'user_add'];

    public function details()
    {
        return $this->hasMany(PurchasingItem::class, 'purchasing_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function discount()
    {
        return $this->hasOne(PurchasingDiscount::class, 'purchasing_id', 'id');
    }
}
