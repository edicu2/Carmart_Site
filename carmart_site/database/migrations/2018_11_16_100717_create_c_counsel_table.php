<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCCounselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ccounsel', function (Blueprint $table) {
            $table->increments('num');
            $table->string('id');
            $table->string('name');
            $table->string('divide');
            $table->string('title');
            $table->longText('content');
            $table->string('phone');
            $table->integer('end');
            $table->integer('private');
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
        Schema::dropIfExists('cCounsel');
    }
}
