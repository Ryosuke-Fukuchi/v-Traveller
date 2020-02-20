<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Album;
use App\Comment;

class LibrariesController extends Controller
{

  public function index(User $user){
    $albums = $user->subscribing;
    return view('libraries.index', compact('user', 'albums'));
  }

  public function show(User $user, Album $album){
     $posts = $album->contents;
     $comments = $album->comments;
     $boolean = (auth()->user()) ? auth()->user()->subscribing->contains($album->id) : false;
     return view('libraries.show', compact('user', 'album', 'posts', 'comments', 'boolean'));
  }

}
