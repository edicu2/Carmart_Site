<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmember', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('divide');
            $table->string('user_id');
            $table->string('pw');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('sms');
            $table->string('company')->nullable();
            $table->string('ipicture')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address')->nullable();
            $table->string('autoLogin')->nullable();
            $table->integer('emailcheck');
            $table->string('socialiteNum')->nullable();
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
        Schema::dropIfExists('cmember');
    }
}
