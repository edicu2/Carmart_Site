<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cLoginSession extends Model
{

    protected $table = 'sessions';

    public static $rules = [
      'id' => 'required',
      'name' => 'required'
      'divide' => 'required'
    ];

    protected $filable = ['id','name'];
}
