<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\cMemberPost;
use App\Mail\RegisEmailCheck;
use Carbon\Carbon;


class RegisterController extends Controller
{
  public function registerCheck1(Request $request){

    if($request->session()->has('agree')){
      $request->session()->forget('agree');
    }
    $divide = $request->get('divide');
    $request->session()->put('divide', $divide );

    return redirect()->route('regis2');

  }



  public function registerCheck2(Request $request){

    $agree = 1;
    $request->session()->put('agree', $agree );

    return redirect()->route('regis3');
  }




  public function IdDuplication(Request $request){

    $id = $request->get('id');
    if(!$id || strlen($id)<4){
      return 3;
    }
    $cMember = cMemberPost::where('user_id','=',$id)->first();
    if(!$cMember){
      return 1;
    }
    return 2;
  }

  public function addFile(Request $request){
    $id = $request->get('id');
    $file = $request->file("upload");
    $storagePath = "/public/MemberPicture";
    $file_extension = $file->getClientOriginalExtension();
    if ($file) {
      $path=$file->storeAs($storagePath , $id.".".$file_extension);
      return $path;
    }else {
      return "파일 업로드 실패했습니다.";
    }
  }


  public function RegisterRequest(Request $request){
    $divide = $request->session()->get('divide');
    $id =  $request->get('id');
    $pw =  $request->get('pwc');
    $name =  $request->get('name');
    $email =  $request->get('email');
    $phone =  $request->get('phone');
    $sms =  $request->get('sms');
    $company =  $request->get('company');
    $upload_name =  $id.".".explode(".",$request->get('upload_name'))[1];
    $postcode =  $request->get('postcode');
    $emailcheck = $request->session()->get('socialNum')?1:0;
    if($request->has('address1'))
      $address =  $request->get('address1').$request->get('address2');
    else{
      $address = null;
    }
    cMemberPost::insert(array(
                         'divide'=>$divide,
                         'user_id'=>$id,
                         'pw'=>$pw,
                         'name'=>$name,
                         'email'=>$email,
                         'phone'=>$phone,
                         'sms'=>$sms,
                         'company'=>$company,
                         'ipicture'=>$upload_name,
                         'address'=>$address,
                         'postcode'=>$postcode,
                         'emailcheck'=>$emailcheck,
                         'socialiteNum'=>$request->session()->get('socialNum')??"",
                         'created_at' => Carbon::now(),
    ));
    if($emailcheck == 0){
      $data = [
                'id' => $id,
                'name' => $name,
               'email' => "$email",
               'ip' =>$request->ip(),
               'serverIp' => route('emailCheck',['emailcheck' => 1,'id'=>$id])
              ];
      Mail::to($data['email'])->send(new RegisEmailCheck($data));
    }
  }

  public function register4(Request $request){
    $emailcheck = 0;
    if($request->session()->get('socialNum')!=null){
      $emailcheck = 1;
      $Alert = '회원가입이 완료되었습니다.';
    }else
      $Alert = '입력한 이메일에서 인증 후 이용해주세요.';
    $request->session()->put('socialNum');
    $request->session()->put('socialEmail');
    return redirect()->route('regis4_1',['emailcheck'=>$emailcheck])->with(['Alert' =>$Alert]);
  }


  public function EmailCheck(Request $request){
    cMemberPost::where('user_id',"=",$request->id)
    ->update(array(
        'emailcheck' => $request->emailcheck,
        'updated_at' => Carbon::now()
    ));
    return redirect()->route('loginP')->with(['Alert' =>'이메일이 확인되었습니다. 로그인해주세요.']);
  }
}
