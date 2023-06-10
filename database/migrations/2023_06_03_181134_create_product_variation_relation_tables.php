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
            $table->boolean('active')->default(false);
            $table->integer('user_add');
            $table->timestamps();
        });

        Schema::create('variation_options', function (Blueprint $table) {
            $table->id();
            $table->integer('variation_id');
            $table->string('name', 191);
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
        Schema::dropIfExists('variations');
        Schema::dropIfExists('variation_options');
    }
}
