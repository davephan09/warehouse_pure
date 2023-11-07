<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('module_name');
            $table->string('title');
            $table->text('content')->nullable();
            $table->integer('module_id')->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->integer('noti_id');
            $table->integer('user_id');
            $table->string('read_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('notification_users');
    }
}
