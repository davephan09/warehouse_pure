<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing_discounts', function (Blueprint $table) {
            $table->id();
            $table->integer('purchasing_id');
            $table->boolean('discount_unit')->comment('0:percent;1:price');
            $table->decimal('discount_value', 13, 0)->default(0);
            $table->decimal('total', 13, 0)->default(0);
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
        Schema::dropIfExists('purchasing_discounts');
    }
}
