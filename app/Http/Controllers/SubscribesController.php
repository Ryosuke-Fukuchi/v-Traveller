<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class SubscribesController extends Controller
{

  public function __construct()
  {
      $this->middleware('verified');
  }

  public function store(Album $album) {
    if(auth()->user()->id !== $album->user_id){
      auth()->user()->subscribing()->toggle($album);
    }else{
      return;
    }
  }




}
