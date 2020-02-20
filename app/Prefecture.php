<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{

  protected $fillable = ['pre', 'pre_eng'];

  public function posts(){
    return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
  }

}
