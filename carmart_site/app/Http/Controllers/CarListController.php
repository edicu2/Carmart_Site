<?php

namespace App\Http\Controllers;

use App\Events\ShippingStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarListController extends Controller
{
  public function SearchCar(Request $request){
    $company_lists = DB::table('ckind')->distinct("global")->get(['company']);
    $search = $request->search??"";
    $cregs = DB::table('creg')
            ->join('ckind', function($join)
            {
              $join->on('creg.c_kind', '=', 'ckind.id');
            })->join('cregimage',function($join)
            {
              $join->on('creg.id','=','cregimage.regnum');
            })
            ->Where('cregimage.filename','LIKE', '%'."\_0\_".'%')
            ->distinct('cregimage.regnum')
            ->orderBy('creg.price')
            ->where('ckind.kind','LIKE','%'.$search.'%')
            ->orWhere('ckind.model','LIKE','%'.$search.'%')
            ->orWhere('ckind.company','LIKE','%'.$search.'%')
            ->get(['creg.id','kind','price','cregimage.filename']);

    if(count($cregs) && $search){
      $csearchRecode = DB::table('csearchrecode')
                      ->where('user_ip',$request->ip())
                      ->where('keyword',$search)
                      ->get()??"";
      if(!count($csearchRecode)){

        DB::table('csearchrecode')
                    ->insert(array(
                      'user_ip' => $request->ip(),
                      'keyword' => $search,
                  ));
        $csearchRank = DB::table('csearchrank')
        ->where('keyword',$search)->get();

        if(count($csearchRank)){

          $csearchRank = DB::table('csearchrank')->where('keyword',$search)->increment('hits');

        }else {

          $csearchRank = DB::table('csearchrank')->where('keyword',$search)->insert(array(
              'keyword'=> $search,
              'hits' => 1
          ));
        }
      }else{

      }
    }
    return view('page.list.car', compact('company_lists', 'cregs','sd'));
  }




  public function Domestic(Request $request){
    $company_lists = DB::table('ckind')->where("global","0")->distinct()->get(['company']);
    return view('page.list.domesticCar', compact('company_lists'));
  }

  public function Domestic2(Request $request){
    return view('page.list.domesticCar2');
  }

  public function Domestic3(Request $request){
    if($request->price??"")
      $price = explode(',',$request->price);
    else
      $price = array($request->price1,$request->price2);
    $cregs = $cregs = DB::table('creg')
        ->join('ckind', function($join)
        {
          $join->on('creg.c_kind', '=', 'ckind.id');
        })->join('cregimage',function($join)
        {
          $join->on('creg.id','=','cregimage.regnum');
        })->Where('cregimage.filename','LIKE', '%'."\_0\_".'%')
          ->distinct('cregimage.regnum')
          ->orderBy('creg.price');
    if(count($price) > 1)
      $cregs->whereBetween('price',array($price[0],$price[1]));
    else
      $cregs->where('price',">",$price[0]);
    $cregs =$cregs->get(['creg.id', 'price', 'kind','size','cregimage.filename']);

    return view('page.list.domesticCar3', compact('cregs','price'));
  }

  public function Global(Request $request){
    $company_lists = DB::table('ckind')->where("global","1")->distinct()->get(['company']);
    return view('page.list.globalCar', compact('company_lists'));
  }

  public function Global2(Request $request){
    return view('page.list.globalCar2');
  }




  public function CategoryCheck(Request $request){
    $divide = $request->divide;
    $check = $request->check;
    if($divide == "company")
      $nextDivide ="kind";
    else if($divide == "kind")
      $nextDivide ="model";
    else
      $nextDivide ="grade";

    $lists = DB::table('ckind')->where($divide,'=',$check)->distinct()->get([$nextDivide]);
    return ([ 'list' => $lists, 'divide' => $nextDivide ]);
  }


  public function DomesticSearch(Request $request){
      $global = $request->send??"";
      $company = $request->company??"";
      $kind = $request->kind??"";
      $model = $request->model??"";
      $grade = $request->grade??"";
      $year = $request->year??"";
      $price = $request->price??"";
      $oil = $request->oil??"";
      $gearbox = $request->gearbox??"";
      $cregs = DB::table('creg')
          ->join('ckind', function($join)
          {
            $join->on('creg.c_kind', '=', 'ckind.id');
          })->join('cregimage',function($join)
          {
            $join->on('creg.id','=','cregimage.regnum');
          })->Where('cregimage.filename','LIKE', '%'."\_0\_".'%')
          ->distinct('cregimage.regnum')
          ->orderBy('creg.created_at','desc');
      if($global != null)
          $cregs->where('ckind.global',$global);
      if($company != null)
          $cregs->where('ckind.company','=',$company);
      if($kind != null)
          $cregs->where('ckind.kind','=',$kind);
      if($model != null)
          $cregs->where('ckind.model','=',$model);
      if($grade != null)
          $cregs->where('ckind.grade','=',$grade);
      if($year != null)
          $cregs->where('creg.year','=',$year);
      if($price != null)
          $cregs->where('creg.price','=',$price);
      if($oil != null)
          $cregs->where('creg.oil','=',$oil);
      if($gearbox != null)
          $cregs->where('creg.gearbox','=',$gearbox);
      $cregs =$cregs->get(['creg.id', 'price', 'kind','size','cregimage.filename'])??"";
    return $cregs;

  }
  public function DomesticSearch2_1(Request $request){
    $size = $request->size;
    $cregs = DB::table('creg')
        ->join('ckind', function($join)
        {
          $join->on('creg.c_kind', '=', 'ckind.id');
        })->orderBy('creg.created_at','desc')
          ->where('ckind.size','=',trans('user_definition.car_size'.$size))
          ->distinct()
          ->get(['kind']);
    return compact('cregs','year','oil','gearbox','price');
  }

  public function DomesticSearch2_2(Request $request){
    $size = $request->size??"";
    $kind = $request->kind??"-";
    $year = $request->year??"";
    $price = $request->price??"";
    $oil = $request->oil??"";
    $gearbox = $request->gearbox??"";
    $cregs = DB::table('creg')
        ->join('ckind', function($join)
        {
          $join->on('creg.c_kind', '=', 'ckind.id');
        })->join('cregimage',function($join)
        {
          $join->on('creg.id','=','cregimage.regnum');
        })->Where('cregimage.filename','LIKE', '%'."\_0\_".'%')
        ->distinct('cregimage.regnum')
        ->orderBy('creg.created_at','desc')
          ->where('ckind.size','=',trans('user_definition.car_size'.$size))
          ->latest('creg.created_at');
      if($kind != "-")
          $cregs->where('ckind.kind','=',$kind);
      if($year != (null && 'null'))
          $cregs->where('creg.year','=',$year);
      if($price != (null && 'null'))
          $cregs->where('creg.price','=',$price);
      if($oil != (null && 'null'))
          $cregs->where('creg.oil','=',$oil);
      if($gearbox != (null && 'null'))
          $cregs->where('creg.gearbox','=',$gearbox);
      $cregs =$cregs->get(['creg.id', 'price', 'kind','size','cregimage.filename']);
    return compact('cregs','year','oil','gearbox','price','kind','size');
  }

}
