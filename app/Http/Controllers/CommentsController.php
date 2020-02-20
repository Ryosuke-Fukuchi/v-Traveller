<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Comment;

class CommentsController extends Controller
{

  public function __construct()
  {
      $this->middleware('verified');
  }

  public function store(Album $album) {
    $data = request()->validate([
      'content' => 'required|string|max:255',
    ]);
    auth()->user()->comments()->create([
      'album_id' => $album->id,
      'content' => $data['content'],
    ]);
  }

  public function destroy(Comment $comment) {
    $this->authorize('delete', $comment);
    $album_user_id = $comment->album->user_id;
    if(request('userId')){$library_user_id = request('userId');}
    $album_id = $comment->album_id;
    $comment->delete();
    if(request('place') == 'album'){
      return redirect('/album/'.$album_user_id.'/'.$album_id);
    }elseif(request('place') == 'library'){
      return redirect('/library/'.$library_user_id.'/'.$album_id);
    }
  }

}
