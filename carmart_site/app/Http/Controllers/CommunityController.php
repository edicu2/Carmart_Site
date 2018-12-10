<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\ApiNaver;
use App\Api11st;

use App\cGalleryPost;

class CommunityController extends Controller
{
  public function Community1(Request $request ){
    $Api11 = new Api11st($request->page);
    $apiResult = $Api11->getApiXml();
    return view('page.community.community1')->with('apiResult',$apiResult);
  }

  public function Community2(){
    $NaverApi = new ApiNaver();
    $apiResult = $NaverApi->getApiJson();

    return view('page.community.community2')->with('apiResult',$apiResult);
  }

  public function Community3(){
    return view('page.community.community3');
  }

  public function Gallery(){
    $result = cGalleryPost::orderBy('name', 'DESC')->get();
    return view('page.community.gallery',compact('result'));

  }


  public function C3addFile(Request $request){
      $num = 0 ;
      while(true){
        $result = cGalleryPost::where('name','=',$num)->first();
        if(!$result){
          break;
        }
        $num +=1;
      }
      $file = $request->file("upload");
      $storagePath = "/public/galleryPicture/";
      $file_extension = $file->getClientOriginalExtension();
      cGalleryPost::insert(array(
                           'name'=>$num.".".$file_extension,
                           'url'=>$storagePath.$num.".".$file_extension
      ));
      if ($file) {
        $path=$file->storeAs($storagePath , $num.".".$file_extension);
        return $path;
      }else {
        return "파일 업로드 실패했습니다.";
      }
  }

}
