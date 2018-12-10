<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\cMemberPost;
use Cookie;

class MasterController extends Controller
{
    public function GetKeyword(){
      $keywords =  DB::table('csearchrank')->orderBy('hits','desc')->take(6)->get(['keyword']);
      $this->makeEventObject()->trigger('keywords', 'new-reply', ['data' => $keywords]);
      return response()->json([
            'success' => true,
            'keywords' => $keywords,
      ]);
    }

    private function makeEventObject()
    {
        $options = array(
            'cluster' => 'ap1', // Cluster
            'encrypted' => true,
        );
        // You can get all this keys from pusher.com. After register of your app.
        return new Pusher(
            '24c705f4fc6e5505c88a', // public key
            'fba516390bcd17004cb4', // Secret
            '663124', // App_id
            $options
        );
    }

    // post 목록을 보여주는 역할을 수행
    public function Logincheck(Request $request){


      $data = json_decode($request->getContent(), true);
      $id = $data['id'];
      $pw = $data['pwd'];
      $cMember = cMemberPost::where('user_id','=',$id)->first();

      $dPw = isset($cMember->pw)?$cMember->pw:"";
      $dName = isset($cMember->name)?$cMember->name:"";
      $dDivide = isset($cMember->divide)?$cMember->divide:"";
      if( $id && $pw ){
        if($dName){
          if($pw == $dPw){
            if($cMember->emailcheck == null)
              return json_encode(array("ment" => "이메일 인증 후 로그인 해주세요."));
            $request->session()->put('id',$id);
            $request->session()->put('name',$dName);
            $request->session()->put('divide',$dDivide);
            $url = $request->session()->get('url');
            //return response()->json(['response' => '']);

            return json_encode(array("ment" => "로그인 하였습니다.", "url" =>"$url"));
          }else {
            return json_encode(array("ment" => "비밀번호를 확인해주세요.!"));
          }
        }else{
            return json_encode(array("ment" => "아이디 비밀번호를 다시 확인해주세요."));
        }
      }else{
        return json_encode(array("ment" => "아이디 비밀번호를 모두 입력해주세요."));
      }
      //return redirect(URL::route('/'));
    }


    public function Logoutcheck(Request $request){
      if($request->session()->has('id')){
        $request->session()->forget('id');
        $request->session()->forget('name');
        $request->session()->forget('divide');
        $url = $request->session()->get('url');
        return response()
              ->json(['ment' => '로그아웃하였습니다.!', 'url' => $url])
              ->withCookie('save_id')
              ->withCookie('save_pw');
      }
    }






}

?>
