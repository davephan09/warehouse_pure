<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('options');
            $table->string('name');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 13, 0)->default(0);
            $table->string('sku', 100)->nullable();
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
        Schema::dropIfExists('variation_products');
    }
}
