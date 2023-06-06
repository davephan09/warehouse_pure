<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationOption extends Model
{
    use HasFactory;
    protected $table = 'variation_options';
    public $timestamps = true;
    protected $fillable = ['variation_id', 'name'];

    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id', 'id');
    }
}
