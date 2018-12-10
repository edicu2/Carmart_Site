<?php

namespace App\Http\Controllers;

use App\cMemberPost;
use Illuminate\Http\Request;
use Socialite;
use Exception;



class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $joinExist = cMemberPost::
            where('socialiteNum',$googleUser->id)
            ->orWhere('email',$googleUser->email)
            ->first()??"";
            if($joinExist){
              $request->session()->put('id', $joinExist->user_id );
              $request->session()->put('name', $joinExist->name);
              return redirect('')->with(['Alert' => '로그인하였습니다.']);
            }else{
              $request->session()->put('socialNum', $googleUser->id );
              $request->session()->put('socialEmail', $googleUser->email);
              $request->session()->put('socialNum');
              $request->session()->put('socialEmail');
              return redirect('register')->with(['Alert' => '나머지 양식을 작성한 후 가입을 완료합니다.']);
            }

        }
        catch (Exception $e) {
            return $e;
        }
    }
}
