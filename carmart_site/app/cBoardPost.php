<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cBoardPost extends Model
{

    protected $table = 'cboard';

    public static $rules = [
      'carName' => 'required',
      'price' => 'required',
      'img' => 'required',
      'kind' => 'required',
    ];

    protected $filable = ['carName','price','img','kind'];
}
