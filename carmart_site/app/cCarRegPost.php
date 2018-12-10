<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cCarRegPost extends Model
{

  // company , kind, model,grade,
  // year, distinct, color, gear , accident, oil, carnum,price
    protected $table = 'creg';

    public static $rules = [
      'c_kind' => 'required',
      'distinct' => 'required',
      'color'=> 'required',
      'accident' =>'required',
      'carnum' => 'required',
      'oil' => 'required',
      'gearbox' => 'required',
      'year' => 'required',
      'price' => 'required',
      'content' => 'required',
      'created_at' => 'required',
    ];

    protected $filable = ['c_kind','distinct','color','accident','carnum','oil','gearbox','year','price','content','created_at'];
}
