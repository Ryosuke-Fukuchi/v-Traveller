<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Album;
use App\Comment;

class AlbumsShowController extends Controller
{

  public function index(User $user){
    return view('albums.index', compact('user'));
  }

  public function show(User $user, Album $album){
     $posts = $album->contents;
     $comments = $album->comments;
     $boolean = (auth()->user()) ? auth()->user()->subscribing->contains($album->id) : false;
     return view('albums.show', compact('user', 'album', 'posts', 'comments', 'boolean'));
  }

}
