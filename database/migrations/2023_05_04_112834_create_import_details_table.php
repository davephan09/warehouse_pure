<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_details', function (Blueprint $table) {
            $table->id();
            $table->integer('import_id');
            $table->integer('product_id');
            $table->integer('option_id');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 13, 0)->default(0);
            $table->decimal('discount', 13, 0)->default(0);
            $table->decimal('tax', 13, 0)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_details');
    }
}
