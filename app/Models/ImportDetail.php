<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;
    protected $table = 'import_details';
    public $timestamps = true;
    protected $fillable = ['import_id', 'product_id', 'quantity', 'price', 'discount', 'tax', 'option_id'];

    public function import()
    {
        return $this->belongsTo(Import::class, 'import_id', 'id');
    }
}
