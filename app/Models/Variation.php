<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    protected $table = 'variations';
    public $timestamps = true;
    protected $fillable = ['name', 'description', 'active', 'user_add'];
    public function options()
    {
        return $this->hasMany(VariationOption::class, 'variation_id', 'id');
    }
}
