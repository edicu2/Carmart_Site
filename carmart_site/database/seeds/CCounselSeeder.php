<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class CCounselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $table = 'ccounsel';

    public function run()
    {
      for( $i=0; $i<20; $i++){
        DB::table('ccounsel')->insert([
           [
               'id' =>'edicu2',
               'name' =>'홍길동',
               'divide' =>'sell',
               'title' =>'bmw520 구매 문의 합니다.',
               'content' =>'연락바랍니다.',
               'phone' =>'01024232323',
               'end' => 0,
               'private' => 0

           ]
       ]);
      }
    }
}
