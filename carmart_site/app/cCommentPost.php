<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cCommentPost extends Model
{

    protected $table = 'ccomment';

    public static $rules = [
      'id' => 'required',
      'board_num' => 'required',
      'user_id' => 'required',
      'comment' => 'required',
      'created_at' => 'required'
    ];

    protected $filable = ['id', 'board_num', 'user_id', 'comment', 'created_at'];
}
