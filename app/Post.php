<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  protected $guarded = [];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function category(){
    return $this->belongsTo(Category::class);
  }

  public function prefecture(){
    return $this->belongsTo(Prefecture::class);
  }

  public function gottenStars(){
    return $this->belongsToMany(User::class);
  }

  public function albums(){
    return $this->belongsToMany(Album::class);
  }

}
