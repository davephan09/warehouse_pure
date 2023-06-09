<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $fillable = ['name', 'province', 'district', 'ward', 'detail_address', 'phone', 'email', 'bank_code', 'account_number', 'note', 'active', 'user_add'];
    public $timestamps = true;
}
