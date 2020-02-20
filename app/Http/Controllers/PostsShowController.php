<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Prefecture;
use App\Category;
use App\Album;

class PostsShowController extends Controller
{


  public function show(Post $post){
     $before = $post->user->posts->where('prefecture_id', $post->prefecture_id)->where('id', '>', $post->id)->last();
     $after = $post->user->posts->where('prefecture_id', $post->prefecture_id)->where('id', '<', $post->id)->first();
     $boolean = (auth()->user()) ? auth()->user()->givenStars->contains($post->id) : false;
     $albums = [];
     $added_albums = [];
     if(auth()->user()){
       if(auth()->user()->id === $post->user_id){
         foreach ($post->user->albums as $alb) {
           if($post->albums->contains($alb->id)){
             $added_albums[] = $alb;
           }else{
             $albums[] = $alb;
           }
         }
       }
     }
     return view('posts.show.show', compact('post', 'before', 'after', 'boolean', 'albums', 'added_albums'));
  }

  public function show_category(Category $category, Post $post){
     $before = $post->user->posts->where('prefecture_id', $post->prefecture_id)->where('category_id', $category->id)->where('id', '>', $post->id)->last();
     $after = $post->user->posts->where('prefecture_id', $post->prefecture_id)->where('category_id', $category->id)->where('id', '<', $post->id)->first();
     $boolean = (auth()->user()) ? auth()->user()->givenStars->contains($post->id) : false;
     $albums = [];
     $added_albums = [];
     if(auth()->user()){
       if(auth()->user()->id === $post->user_id){
         foreach ($post->user->albums as $alb) {
           if($post->albums->contains($alb->id)){
             $added_albums[] = $alb;
           }else{
             $albums[] = $alb;
           }
         }
       }
     }
     return view('posts.show.show_category', compact('post', 'before', 'after', 'boolean', 'albums', 'added_albums'));
  }

  public function show_album(Album $album, Post $post){
     $before = $album->contents->where('id', '>', $post->id)->last();
     $after = $album->contents->where('id', '<', $post->id)->first();
     $boolean = (auth()->user()) ? auth()->user()->givenStars->contains($post->id) : false;
     return view('posts.show.show_album', compact('post', 'album', 'before', 'after', 'boolean'));
  }

  public function show_library(User $user, Album $album, Post $post){
     $before = $album->contents->where('id', '>', $post->id)->last();
     $after = $album->contents->where('id', '<', $post->id)->first();
     $boolean = (auth()->user()) ? auth()->user()->givenStars->contains($post->id) : false;
     return view('posts.show.show_library', compact('user', 'post', 'album', 'before', 'after', 'boolean'));
  }

  public function show_general(Post $post) {
    $boolean = (auth()->user()) ? auth()->user()->givenStars->contains($post->id) : false;
    $albums = [];
    $added_albums = [];
    if(auth()->user()){
      if(auth()->user()->id === $post->user_id){
        foreach ($post->user->albums as $alb) {
          if($post->albums->contains($alb->id)){
            $added_albums[] = $alb;
          }else{
            $albums[] = $alb;
          }
        }
      }
    }
    return view('posts.show.show_general', compact('post', 'boolean', 'albums', 'added_albums'));
  }



}
