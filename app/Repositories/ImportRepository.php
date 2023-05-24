<?php 
namespace App\Repositories;

use App\Models\Import;

class ImportRepository extends Repository
{
    public function getModel(): string
    {
        return Import::class;
    }

}