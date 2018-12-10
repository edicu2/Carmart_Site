<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cCounselPost extends Model
{
  protected $table = 'ccounsel';

  public static $rules = [
    //'num' => 'required',
    'num' => 'required',
    'id' => 'required',
    'name' => 'required',
    'divide' => 'required',
    'title' => 'required',
    'content' => 'required',
    'phone' => 'required',
    'created_at' => 'required',
    'updated_at' => 'required',
    'end' => 'required',
    'private' => 'required'
  ];

  protected $filable = ['num','id','name','divide','title','content','phone','created_at','updated_at','end','private'];

}
