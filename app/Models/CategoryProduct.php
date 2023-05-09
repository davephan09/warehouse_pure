<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'category_products';
    public $timestamps = true;
    protected $fillable = ['name', 'parent_id', 'description', 'thumb', 'active', 'user_add'];
}
