<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  protected $fillable = [
      'content', 'album_id'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function album(){
    return $this->belongsTo(Album::class);
  }


}
