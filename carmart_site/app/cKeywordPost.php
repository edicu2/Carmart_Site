<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cCommentPost extends Model
{
    protected $table = 'csearchrank';

    public static $rules = [
      'id' => 'required',
      'keyword' => 'required',
      'hits' => 'required',
    ];

    protected $filable = ['id', 'keyword', 'hits'];
}
