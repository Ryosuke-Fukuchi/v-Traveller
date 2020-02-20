<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Album;
use App\Category;

class AddsController extends Controller
{

  public function __construct()
  {
      $this->middleware('verified');
  }

  public function store(Post $post) {
    $album = Album::find(request('album'));
    if(auth()->user()->id === $post->user_id){
      $post->albums()->toggle($album);
      return redirect('/p/'.$post->id);
    }else{
      return;
    }
  }

  public function store_category(Category $category, Post $post) {
    $album = Album::find(request('album'));
    if(auth()->user()->id === $post->user_id){
      $post->albums()->toggle($album);
      return redirect('/p/'.$category->id.'/'.$post->id);
    }else{
      return;
    }
  }

  public function restore(Post $post, Album $album) {
    if(auth()->user()->id === $post->user_id && auth()->user()->id === $album->user_id){
      $post->albums()->toggle($album);
      return redirect('/album/'.$post->user_id.'/'.$album->id);
    }else{
      return;
    }
  }




}
