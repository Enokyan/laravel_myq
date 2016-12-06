<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTable extends Migration
{
    public function up()
    {
         Schema::create('chat', function (Blueprint $table) {
            $table->increments('id');
            $table->text('msg');
            $table->integer('chack');
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('img');
            $table->timestamps();
        });
    }

    public function down()
    {
       Schema::drop('chat');
    }
}
