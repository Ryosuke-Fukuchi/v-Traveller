<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

  protected $guarded = [];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function contents(){
    return $this->belongsToMany(Post::class)->orderBy('created_at', 'DESC');
  }

  public function subscribers(){
    return $this->belongsToMany(User::class);
  }

  public function comments(){
    return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
  }

}
