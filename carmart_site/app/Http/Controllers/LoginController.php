<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Socialite;
use Mail;
use App\Http\Controllers;
use Crypt;
use Illuminate\Support\Facades\DB;
use App\cMemberPost;
use App\cLoginSession;
use App\Mail\IdSearchMail;
use App\Mail\PwSearchMail;

class LoginController extends Controller
{
  public function LoginCheck(Request $request){
    $id = $request->get('id');
    $pw = $request->get('pwd');
    // validate 를 사용해서 아이디가 있을 경우에만 접속할 수 있도록 $this->validate($request,
                  //  ['title'=>'required',
                  //    'writer' => 'required',
                  //  ]);
    if($request->get('auto_id')=='true')
      $aId = $id;
    if($request->get('auto_login')=='true'){
      $sId = $id;
      $sPw = $pw;
    }
    // cMember에서 받은 것들은 없을 수 있기에 isset;
    $cMember = cMemberPost::where('user_id','=',$id)->first();
    $dPw = isset($cMember->pw)?$cMember->pw:"";
    $dName = isset($cMember->name)?$cMember->name:"";
    $dDivide = isset($cMember->divide)?$cMember->divide:"";
    $emailcheck = $cMember->emailcheck??"";
    if( $id && $pw ){
      if($dName){
        if($pw == $dPw){
          if($emailcheck == null)
            return response("이메일 인증 후 사용해주세요.");
          $request->session()->put('id',$id);
          $request->session()->put('name',$dName);
          $request->session()->put('divide',$dDivide);
          return response('로그인 성공!')
          ->withCookie(cookie()->forever('auto_id',isset($aId)?$aId:""))
          ->withCookie(cookie()->forever('save_id',isset($sId)?$sId:""))
          ->withCookie(cookie()->forever('save_pw',isset($sPw)?$sPw:"")); //로그인 성공!
        }else {
          return response("비밀번호를 다시확인해주세요.");
        }
      }else{
          return response("아이디 비밀번호를 다시확인해주세요.");
      }
    }else{
      return response( "아이디 비밀번호를 모두 입력해주세요.");
    }
    //return redirect(URL::route('/'));
  }

  public function IdSearchMail(Request $request){
    $name = $request->name??"";
    $email1 = $request->email??"";
    $email2 =  $request->email2??"";
    $cMember = DB::table('cmember')
                 ->where('name',$name)
                 ->where('email', $email1."@".$email2)
                 ->first();
    $data = ['name'=>$name ,
              'ip' =>$request->ip(),
              'id' => $cMember->user_id,
             'email' => "$email1@$email2",
             'serverIp' => route('loginP')
            ];
    if($cMember->email){
      Mail::to($data['email'])->send(new IdSearchMail($data));
    }
  }


  public function PwSearchMail(Request $request){
    $name = $request->name??"";
    $id = $request->id??"";
    $email1 = $request->email??"";
    $email2 =  $request->email2??"";
    $cMember = DB::table('cmember')
                  ->where('name','=',$name)
                  ->where('user_id','=',$id)
                  ->where('email',"$email1@$email2")
                  ->first();
    $data = ['name'=>$name,
             'id' => $id,
              'ip' =>$request->ip(),
             'pw' => $cMember->pw,
             'email' => "$email1@$email2",
             'serverIp' => route('loginP')
            ]; // car 이름
    if($cMember->email){
      Mail::to($data['email'])->send(new PwSearchMail($data));
    }
  }
}
