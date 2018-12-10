<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class CarSeeController extends Controller
{
  public function CarSee(Request $request, $regnum){
      $car_info = DB::table('creg')
                ->join('ckind',function($join){
                   $join->on('ckind.id', '=','creg.c_kind');
                })->where('creg.id',$regnum)
                ->first();
      $car_img = DB::table('cregimage')->where('regnum',$regnum)->get();
      $user_info = DB::table('cmember')->where('user_id',$car_info->user_id)->first();
      return view('page.carSee.carSee', compact('user_info','car_info','car_img'));
  }
}
