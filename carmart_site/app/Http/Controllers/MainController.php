<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\counselSMS;
use App\cBoardPost;
use App\cMemberPost;
use Carbon\Carbon;

class MainController extends Controller
{
    // post 목록을 보여주는 역할을 수행
    public function index(Request $request)
    {
      $save_id = $request->cookie('save_id');
      $save_pw = $request->cookie('save_pw');
      if($save_id){
          $result=cMemberPost::where('user_id','=',$save_id)->first();
          if($result['pw'] == $save_pw){
            $request->session()->put('id',$result['id']);
            $request->session()->put('name',$result['name']);
          }
      }
      $cPosts = DB::table('creg')
          ->join('ckind', function($join)
          {
            $join->on('creg.c_kind', '=', 'ckind.id');
          })->join('cregimage',function($join){
            $join->on('creg.id','=','cregimage.regnum');
          })->distinct('cregimage.regnum')
          ->Where('cregimage.filename', 'like', '%_0_%')
          ->orderBy('creg.created_at','desc')
            ->select('creg.id', 'price', 'kind','size','cregimage.filename')
            ->paginate(48);

      $kind_lists = DB::table('ckind')->distinct()->get(['company']);
      return view('page.main.main', compact('cPosts','kind_lists'));
    }

    public function CarKindSearch(Request $request){
      $models = DB::table('ckind')->where('company',$request->company)->distinct()->get(['kind']);
      return $models;
    }

    public function CarListUpdate(Request $request){
      $size = $request->size;
      $cPosts = DB::table('creg')
          ->join('ckind', function($join)
          {
              $join->on('creg.c_kind', '=', 'ckind.id');
          })->join('cregimage',function($join)
          {
            $join->on('creg.id','=','cregimage.regnum');
          })->distinct('cregimage.regnum')
          ->Where('cregimage.filename','LIKE', '%'."\_0\_".'%')
          ->orderBy('creg.created_at','desc')
          ->latest('creg.created_at');
      if ($size != 0) {
          $cPosts->where('ckind.size','=',trans('user_definition.car_size'.$size));
      }
      $cPosts =$cPosts->get(['creg.id', 'price', 'kind','size','cregimage.filename']);
      return $cPosts;
    }



    public function counselSMS(counselSMS $request){
      $validated = $request->validated();
      DB::table('ccounselnl')->insert(array(
        'c_divide'=>$request->purchase,
        'c_carname'=>$request->car2,
        'c_phone'=>$request->tel,
        'created_at'=> Carbon::now()
      ));
      return redirect()->intended('/')->with( ['Alert' => "상담을 신청하였습니다."] );;
    }
}

?>
