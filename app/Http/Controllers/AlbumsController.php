<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Album;

class AlbumsController extends Controller
{

  public function __construct() {
      $this->middleware('verified');
  }

  public function create() {
    return view('albums.create');
  }

  public function store(){
    $data = request()->validate([
      'title' => 'required|string|max:45',
      'caption' => 'required',
      'image' => ['required', 'image']
    ]);

    $imagePath = request('image')->store('album_thumbnails', 'public');
    $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 900);
    $image->save();

    auth()->user()->albums()->create([
      'title' => $data['title'],
      'caption' => $data['caption'],
      'image' => $imagePath
    ]);
    return redirect('/album/'.auth()->user()->id);
  }

  public function edit(Album $album) {
    $this->authorize('update', $album);
    return view('albums.edit', compact('album'));
  }

  public function update(Album $album) {
    $this->authorize('update', $album);
    $data = request()->validate([
      'title' => 'required',
      'caption' => 'required',
      'image' => 'image',
    ]);

    if(request('image')){
      $imagePath = request('image')->store('album_thumbnails', 'public');
      $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 900);
      $image->save();
      $imageArray = ['image' => $imagePath];
      Storage::disk('public')->delete($album->image);
    }

      $album->update(array_merge(
      $data,
      $imageArray ?? []
    ));

    return redirect('/album/'.$album->user_id.'/'.$album->id);
  }

  public function destroy(Album $album) {
    $this->authorize('delete', $album);
    $userId = $album->user_id;
    $album->delete();
    return redirect('/album/'.$userId);
  }





}
