<?php

namespace App\Http\Controllers;

use App\cMemberPost;
use Illuminate\Http\Request;
use Socialite;
use Exception;


class SocialAuthFacebookController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirect()
    {
        return redirect()->route('loginP')->with(['Alert' => 'facebook로그인은 프로토콜 문제로 지원하지 않습니다.']);
        return Socialite::driver('github')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function callback()
    {
        try {
            $faceUser = Socialite::driver('facebook')->user();
            $joinExist = cMemberPost::where('socialiteNum',$faceUser->id)->first()??"";
            if($joinExist){
              $request->session()->put('id', $joinExist->user_id );
              $request->session()->put('name', $joinExist->name);
              return redirect('')->with(['Alert' => '로그인하였습니다.' ]);
            }else{
              $request->session()->put('socialNum', $faceUser->id );
              $request->session()->put('socialEmail', $faceUser->email);
              return redirect('register')->with(['Alert' => '나머지 양식을 작성한 후 가입을 완료합니다.']);
            }
        }
        catch (Exception $e) {
            return $e;
        }
    }
}
/*try {
    $user = Socialite::driver('facebook')->user();
    $create['name'] = $user->getName();
    $create['email'] = $user->getEmail();
    $create['facebook_id'] = $user->getId();


    $userModel = new User;
    $createdUser = $userModel->addNew($create);
    Auth::loginUsingId($createdUser->id);


    return redirect()->route('home');

} catch (Exception $e) {

    return redirect('auth/facebook');


}*/
