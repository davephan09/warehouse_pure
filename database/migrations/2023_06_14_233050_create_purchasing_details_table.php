<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('purchasing_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('option_id');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 13, 0)->default(0);
            $table->decimal('discount', 13, 0)->default(0);
            $table->decimal('tax', 13, 0)->default(0);
            $table->decimal('total', 13, 0)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('purchasing_id');
            $table->index('product_id');
            $table->index('option_id');
        });

        Schema::create('purchasing_item_taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('tax_id');
            $table->boolean('type')->default(false)->comment('0:percent,1:number');
            $table->decimal('value', 13, 0)->default(0)->comment('tax value of item');
            $table->decimal('amount', 13, 0)->default(0)->comment('amount of tax');

            $table->index('item_id');
            $table->index('tax_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchasing_items');
        Schema::dropIfExists('purchasing_item_taxes');
    }
}
