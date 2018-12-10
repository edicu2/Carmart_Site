<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MyController extends Controller
{
  public function MyInfo(Request $request){
    $id = $request->session()->get('id');
    $cmember = DB::table('cmember')->where('user_id',$id)->first();
    return view('page.my.mySee', compact('cmember'));
  }

  public function MyUpdate(Request $request){
    $id = $request->session()->get('id');
    $cmember = DB::table('cmember')->where('user_id',$id)
    ->update(array(
      'pw'=>$request->pwc,
      'email'=>$request->email1."@".$request->email2,
      'phone'=>$request->tel1.$request->tel2.$request->tel3,
      'sms'=>$request->resms,
      'company'=>$request->company??"",
      'ipicture'=>$request->upload_name,
      'address'=>$request->address1??""." ".$request->address2??"",
      'postcode'=>$request->postcode??""
    ));
    return redirect()->intended('/')->with( ['Alert' => "회원정보를 수정하였습니다."] );
  }

}
