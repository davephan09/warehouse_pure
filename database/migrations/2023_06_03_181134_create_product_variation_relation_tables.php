<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationRelationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('variation_options', function (Blueprint $table) {
            $table->id();
            $table->integer('variation_id');
            $table->string('name', 191);
            $table->timestamps();
        });

        Schema::create('product_has_variation_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('option_id');
            $table->string('name');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 13, 0)->default(0);
            $table->string('sku', 100)->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('variation_options')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variations');
        Schema::dropIfExists('variation_options');
        Schema::dropIfExists('product_has_variation_options');
    }
}
