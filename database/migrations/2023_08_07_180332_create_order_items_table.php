<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('option_id');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 13, 0)->default(0);
            $table->decimal('discount', 13, 0)->default(0);
            $table->decimal('tax', 13, 0)->default(0);
            $table->decimal('total', 13, 0)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_id');
            $table->index('product_id');
            $table->index('option_id');
        });

        Schema::create('order_item_taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('tax_id');
            $table->decimal('percent', 13, 3)->default(0)->comment('tax percent of item');
            $table->decimal('value', 13, 0)->default(0)->comment('tax value of item');

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
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('order_item_taxes');
    }
}
