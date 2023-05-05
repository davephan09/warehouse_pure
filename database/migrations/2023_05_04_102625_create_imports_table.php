<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id('import_id');
            $table->string('importer_name', 191);
            $table->string('date', 20);
            $table->integer('supplier_id');
            $table->decimal('cost_sum', 13, 0)->default(0);
            $table->decimal('discount', 13, 0)->nullable();
            $table->decimal('real_cost', 13, 0)->default(0);
            $table->decimal('paid_money', 13, 0)->default(0);
            $table->decimal('dept_money', 13, 0)->default(0);
            $table->string('transporter', 150)->nullable();
            $table->text('note')->nullable();
            $table->string('transporter_phone', 20)->nullable();
            $table->integer('user_add');
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
        Schema::dropIfExists('imports');
    }
}
