<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class CRegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $table = 'cregimage';

    public function run()
    {
      for( $i=1; $i<113; $i++){
        DB::table('cregimage')->insert([
           [
               'regnum' =>$i,
               'filename' =>$i."_0_073225.jpg",
               'created_at' =>Carbon::now(),
           ]
       ]);
      }
    }
}
