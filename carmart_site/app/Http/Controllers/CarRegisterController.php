<?php

namespace App\Http\Controllers;

use App\Http\Requests\carRegister;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\cCarRegPost;
use App\cMemberPost;
use App\cKindPost;
use Carbon\Carbon;

class CarRegisterController extends Controller
{
  public function CarRegister(Request $request){
    $login_user = $request->session()->get('id');
    $user = cMemberPost::where('user_id',$login_user)->first(['user_id','name','phone']);
    DB::table('creg')->insert(array('user_id' => $login_user));
    $company_lists = DB::table('ckind')->distinct("global")->get(['company']);
    return view('page.carRegis.carRegister',['company_lists' => $company_lists,'user'=>$user]);
  }

  public function CarRegisterRequest(carRegister $request){
    // company , kind, model,grade,
    // year, distinct, color, gear , accident, oil, carnum,price
    $login_user = $request->session()->get('id');
    $model = $request->model;
    $grade = $request->grade;
    $cKind = DB::table('ckind')->where('model',$model)->where('grade',$grade)->first();
    $year = $request->year;
    $distinct = $request->distinct;
    $color = $request->color;
    $gear = $request->gear;
    $accident = $request->accident;
    $oil = $request->oil;
    $carnum = $request->carnum;
    $price = $request->price;
    $content = $request->content;
    $sumnail = $request->sumnail_image_num;
    $regNum = DB::table('creg')->where('user_id',$login_user)->latest('id')->first();
    DB::table('creg')->where('id',$regNum->id)
    ->update(array(
      'c_kind' => $cKind->id,
      'distinct' => $distinct,
      'color' => $color,
      'accident' => $accident,
      'carnum'=> $carnum,
      'oil' =>$oil,
      'gearbox' => $gear,
      'year' => $year,
      'price' => $price,
      'content' => $content,
      'sumnail_img' => $sumnail,
      'created_at' => Carbon::now(),
    ));
    return redirect(url('CarSee/'.$regNum->id))->with(['Alert' =>'매물을 등록하였습니다.']);
  }
}
