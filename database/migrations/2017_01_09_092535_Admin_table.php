<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminTable extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
             $table->integer('online')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
