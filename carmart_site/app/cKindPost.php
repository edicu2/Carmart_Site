<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cKindPost extends Model
{

    protected $table = 'ckind';

    public static $rules = [
      'id' => 'required',
      'keyword' => 'required',
      'hits' => 'required',
    ];

    protected $filable = ['id', 'keyword', 'hits'];
}
