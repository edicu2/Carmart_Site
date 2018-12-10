<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cMemberPost extends Model
{
  protected $table = 'cmember';

  public static $rules = [
    //'num' => 'required',
    'divide' => 'required',
    'id' => 'required',
    'pw' => 'required',
    'name' => 'required',
    'email' => 'required',
    'phone' => 'required',
    'sms' => 'required',
    'company' => 'required',
    'ipicture' => 'required',
    'postcode' => 'required',
    'address' => 'required',
    'autoLogin' => 'required',
    'emailcheck' =>'required',
    'socialNum' => 'required',
    'created_at'=> 'default',
  ];

  protected $filable = ['num','divide','id','pw','name','email','phone','sms','company','ipicture','postcode','address','autoLogin','emailcheck','created_at','updated_at','socialNum'];


}
