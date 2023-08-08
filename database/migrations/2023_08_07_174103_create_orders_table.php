<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('date', 20);
            $table->unsignedInteger('customer_id');
            $table->decimal('cost', 13, 0)->default(0);
            $table->decimal('paid', 13, 0)->default(0);
            $table->decimal('debt', 13, 0)->default(0);
            $table->text('note')->nullable();
            $table->integer('user_add');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
