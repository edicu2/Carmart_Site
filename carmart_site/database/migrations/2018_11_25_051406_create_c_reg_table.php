<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCRegTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('c_kind')->nullable();
            $table->integer('distinct')->nullable();
            $table->string('color')->nullable();
            $table->string('accident')->nullable();
            $table->string('carnum')->nullable();
            $table->string('oil')->nullable();
            $table->string('gearbox')->nullable();
            $table->string('year')->nullable();
            $table->integer('price')->nullable();
            $table->string('content')->nullable();
            $table->integer('sumnail_img')->default(0);
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
        Schema::dropIfExists('creg');
    }
}
