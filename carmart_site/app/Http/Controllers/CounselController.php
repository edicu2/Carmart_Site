<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CounselController extends Controller
{

  public function Purchase(){
    $counselResult = DB::table('ccounsel')
                    ->orderBy('created_at','desc')
                    ->whereIn('divide', ['bargain_pur','purchase','etc'])
                    ->paginate(10);
    return view('page.counsel.purchase',['counselResult' => $counselResult]);

  }

  public function Sell(){
    $counselResult = DB::table('ccounsel')
                    ->orderBy('created_at','desc')
                    ->whereIn('divide', ['bargain_sell','sell','etc'])
                    ->paginate(10);
    return view('page.counsel.sell',['counselResult' => $counselResult]);
  }

  public function SeePage(Request $request){
    $num = $request->num??$request->cookie('num');
    $page = $request->pages;
    $ccounsel = DB::table('ccounsel')->where('num',$num)->first();
    $comments = DB::table('ccomment')->where('board_num',$num)
                ->orderBy('created_at','desc')
                ->paginate(10);
    $dapComments = DB::table('cdapcomment')->get();
    return  response()->view('page.counsel.counselSee',compact('ccounsel','comments','dapComments'))
            ->withCookie(cookie()->forever('num',$num))
            ->withCookie(cookie()->forever('page',$page));

  }

  public function UpdatePage(Request $request){
    $num = $request->cookie('num');
    $counselResult = DB::table('ccounsel')->where('num',$num)->first();
    return  view('page.counsel.counselUpdate',['ccounsel' => $counselResult]);
    return $num;

  }

  public function Update(Request $request){
    $num = $request->cookie('num');
    if($request->private)
      $private=1;
    else
      $private=0;
    DB::table('ccounsel')->where('num',$num)->update(array(
      'divide' => $request->divide,
      'title'  => $request->title,
      'content'=> $request->content,
      'phone'  => $request->phone1.$request->phone2.$request->phone3,
      'private'=> $private
    ));
    return redirect()->route('counselPur');
  }


  public function Delete(Request $request){
    $num = $request->cookie('num');
    DB::table('ccounsel')->where('num', $num)->delete();
    return redirect()->route('counselPur');
  }


  public function WritePage(Request $request){
    $id = $request->session()->get('id');
    $info = DB::table('cmember')->where('user_id',$id)->first();
    return view('page.counsel.counselWrite', ['info' => $info]);
    //return $id;
  }
  public function Write(Request $request){
    $id = $request->session()->get('id');
    $url = $request->session()->get('url');
    if($request->checkbox)
      $private=1;
    else
      $private=0;
    DB::table('ccounsel')->insert(array(
      'name' => $request->name,
      'id' => $id,
      'divide' => $request->divide,
      'title'  => $request->title,
      'content'=> $request->content,
      'phone'  => $request->phone1.$request->phone2.$request->phone3,
      'end' => 0,
      'private' => $private,
      'created_at' => Carbon::now()
    ));
    return redirect()
          ->route(trans("user_definition.$request->divide.route"))
          ->with(['Alert'=>'상담을 등록하였습니다.']);

  }

  public function CommentReg(Request $request){
    $boardnum = $request->cookie('num')??"";
    $id = $request->session()->get('id')??"";
    $comment = $request->comment??"";
    $preId = $request->preId??"";
    $preComment = $request->preComment??"";
    $createdTime = (string)Carbon::now();
    if($preId){
      $pre = DB::table('ccomment')
          ->where('user_id',$preId)
          ->where('comment',$preComment)
          ->where('board_num',$boardnum)
          ->first();
      DB::table('cdapcomment')->insert(array(
        'board_num' => $boardnum,
        'user_id' => $id,
        'comment' => $comment,
        'img_url' => "https://t1.daumcdn.net/cfile/tistory/2744963F53D1EF1C01",
        'pre_num' => $pre->id??"",
        'created_at' => $createdTime
      ));
    }
    else{
      DB::table('ccomment')->insert(array(
        'board_num'  => $boardnum,
        'user_id'=> $id,
        'comment'  => $comment,
        'created_at' => $createdTime
      ));
    }
    $preBoard=$pre->id??"";
    return compact('comment','createdTime','preBoard');
  }


  public function CommentDel(Request $request){

    if($request->root == 1){
      $comment_num
      = DB::table('ccomment')
        ->where('user_id',$request->user_Id)
        ->where('comment',$request->comment)
        ->first();
      DB::table('ccomment')
        ->where('user_id',$request->user_Id)
        ->where('comment',$request->comment)
        ->delete();
      DB::table('cdapcomment')
      ->where('pre_num',$comment_num->id)
      ->delete();
    } else{
      DB::table('cdapcomment')
        ->where('user_id',$request->user_Id)
        ->where('comment',$request->comment)
        ->delete();
    }
    return compact('comment_num');
  }


}
