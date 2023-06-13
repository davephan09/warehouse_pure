<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $table = 'imports';
    public $timestamps = true;
    protected $fillable = ['importer_name', 'date', 'supplier_id', 'cost_sum', 'discount', 'real_cost', 'paid_money', 'dept_money', 'transporter', 'note', 'transporter_phone', 'user_add'];

    public function details()
    {
        return $this->hasMany(ImportDetail::class, 'import_id', 'id');
    }

}
