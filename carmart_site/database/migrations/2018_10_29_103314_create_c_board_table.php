<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cBoard', function (Blueprint $table) {
          $table->string('carName');
          $table->string('price');
          $table->string('img');
          $table->integer('kind');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cBoard');
    }
}
/*
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BoardPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //public function up()
    //{
    //    Schema::create('post', function (Blueprint $table) {
    //        $table->string('title');
    //        $table->string('body');
    //    });
    //}

    /**
     * Reverse the migrations.
     *
     *
     */
    //public function down()
    //{
    //    Schema::dropIfExists('post');
    //}
//}


//*/
