<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class UploadController extends Controller
{

  public function upload(Request $request)
  {
    $randomString = Carbon::now()->format('His');
    $upload_successes = [];
    for ($i=0 ; $i < $request["img_size"] ; $i++){
      $reg_num = DB::table('creg')->max('id');
      $img_num = $request["img_num$i"];
      $image = $request->file('upload'.$i);
      $extension = $image->getClientOriginalExtension();
      $directory = 'carRegis_image';
      $filename = $reg_num."_".$img_num."_".$randomString.".".$extension;
      $upload_success = $image->storeAs($directory, $filename,'public');
      array_push($upload_successes, $upload_success );
      DB::table('cregimage')->insert(array(
        "regnum" => $reg_num,
        "filename" => $filename,
        'created_at' =>Carbon::now(),
      ));
    }

    if ($upload_success??"") {
        return response()->json(['upload_successes' => $upload_successes] );
    }
    else {
        return response()->json('error', 400);
    }
  }

  public function delete(Request $request){
    $this_src = explode('/',$request->this_src);
    $file_num = $request->this_src;
    $file_time = $request->this_src;
    Storage::delete('public/carRegis_image/'.$this_src[5]);
    DB::table('cregimage')->where('filename',$this_src[5])->delete();
    return response('public/carRegis_image/'.$this_src[5]);
  }


  public function upload_content(Request $request){
    $image = $request->file('upload');
    $reg_num = DB::table('creg')->max('id');
    $extension = $image->getClientOriginalExtension();
    $directory = 'carRegis_content';
    $filename = $reg_num.".".$extension;
    $upload_success = $image->storeAs($directory, $filename,'public');
    return response()->json(["uploaded"=> $upload_success,
                              "fileName"=> $filename,
                              "url"=>"/storage/".$directory."/".$filename]);
  }
}
