<?php

namespace App\Http\Controllers;

use App\cMemberPost;
use Illuminate\Http\Request;
use Socialite;
use Exception;



class SocialAuthGithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback(Request $request)
    {
        try {
          $gituser = Socialite::driver('github')->user();
          $joinExist = cMemberPost::where('socialiteNum',$gituser->id)->first()??"";
          if($joinExist){
            $request->session()->put('id', $joinExist->user_id );
            $request->session()->put('name', $joinExist->name);
            return redirect('')->with(['Alert' => '로그인하였습니다.' ]);
          }else{
            $request->session()->put('socialNum', $gituser->id );
            $request->session()->put('socialEmail', $gituser->email);
            return redirect('register')->with(['Alert' => '나머지 양식을 작성한 후 가입을 완료합니다.']);
          }

        }
        catch (Exception $e) {
            return $e;
        }
    }
}
