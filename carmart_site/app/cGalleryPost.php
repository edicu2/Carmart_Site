<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cGalleryPost extends Model
{
  protected $table = 'cgallery';

  public static $rules = [
    'divide' => 'required',
    'id' => 'required',
  ];

  protected $filable = ['name','id'];


}
