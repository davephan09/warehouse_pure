<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{
    use HasFactory;
    protected $table = 'purchasings';
    public $timestamps = true;
    protected $fillable = ['purchasing_name', 'date', 'supplier_id', 'cost', 'paid', 'debt', 'note', 'user_add'];

    public function details()
    {
        return $this->hasMany(PurchasingItem::class, 'import_id', 'id');
    }

}
