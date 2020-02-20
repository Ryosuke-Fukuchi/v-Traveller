<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
use App\Prefecture;
use App\Category;
use App\Album;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified');
    }


    public function index() {
      $posts = Post::latest()->simplePaginate(10);
      return view('posts.index.index', compact('posts'));
    }

    public function index_filter() {
      if(request('category')==null && request('prefecture')==null && request('keyword')==null){
        return redirect('/');
      }
      if(request('category')==null){
        $category = null;
      }
      if(request('prefecture')==null){
        $prefecture = null;
      }
      if(request('keyword')==null){
        $keywords = null;
      }

      $query = Post::query();
      if(request('category')!=null){
            $category = Category::where('id', request('category'))->first();
            $query->where('category_id', request('category'));
        }
      if(request('prefecture')!=null){
            $prefecture = Prefecture::where('id', request('prefecture'))->first();
            $query->where('prefecture_id', request('prefecture'));
        }
      if(request('keyword')!=null){
        $keywords = request('keyword');
            if(!empty($keywords)) {
              foreach ($keywords as $keyword) {
                $query->where(function($query) use($keyword){
                  $query->orWhere('title', 'like', '%'.$keyword.'%')
                        ->orWhere('city', 'like', '%'.$keyword.'%')
                        ->orWhere('caption', 'like', '%'.$keyword.'%');
                    });
              }
            }
        }

      $posts = $query->latest()->simplePaginate(10);
      return view('posts.index.index_filter', compact('posts', 'prefecture', 'category', 'keywords'));
    }

    public function index_album() {
      $albums = Album::latest()->simplePaginate(10);
      return view('posts.index.index_album', compact('albums'));
    }

    public function index_album_filter() {
      if(request('keyword')==null){
        return redirect('/albums');
      }else{
        $query = Album::query();
        $keywords = request('keyword');
            if(!empty($keywords)) {
              foreach ($keywords as $keyword) {
                $query->where(function($query) use($keyword){
                  $query->orWhere('title', 'like', '%'.$keyword.'%')
                        ->orWhere('caption', 'like', '%'.$keyword.'%');
                    });
              }
            }
        }
      $albums = $query->latest()->simplePaginate(10);
      return view('posts.index.index_album_filter', compact('albums', 'keywords'));
    }

    public function index_following() {
      $albumIds = auth()->user()->subscribing()->pluck('albums.id');
      $followings = Post::whereHas('albums', function($q) use($albumIds) {
        $q->whereIn('album_id', $albumIds);
      })->latest()->simplePaginate(10);
      return view('posts.index.index_following', compact('followings'));
    }

    public function stars(User $user, Post $post) {
      if(auth()->user()->id === $user->id){
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
        return view('posts.show.show_stars', compact('user', 'post', 'boolean', 'albums', 'added_albums'));
      }
    }

    public function create(Prefecture $prefecture){
      return view('posts.create', compact('prefecture'));
    }

    public function store(){
      $data = request()->validate([
        'title' => 'required|string|max:45',
        'prefecture_id' => 'required',
        'city' => '',
        'category_id' => '',
        'caption' => '',
        'image' => ['required', 'image'],
        'image2' => 'image',
        'image3' => 'image',
        'image4' => 'image'
      ]);

      $imagePath = request('image')->store('uploads', 'public');
      $thumbnailPath = request('image')->store('thumbnails', 'public');
      $image = Image::make(public_path("storage/{$thumbnailPath}"))->fit(1200, 900);
      $image->save();

      $imagePath2 = null;
      $imagePath3 = null;
      $imagePath4 = null;
      if(request('image2')){
        $imagePath2 = request('image2')->store('uploads', 'public');
      }
      if(request('image3')){
        $imagePath3 = request('image3')->store('uploads', 'public');
      }
      if(request('image4')){
        $imagePath4 = request('image4')->store('uploads', 'public');
      }

      auth()->user()->posts()->create([
        'title' => $data['title'],
        'prefecture_id' => $data['prefecture_id'],
        'city' => $data['city'],
        'category_id' => $data['category_id'],
        'caption' => $data['caption'],
        'image' => $imagePath,
        'thumbnail' => $thumbnailPath,
        'image2' => $imagePath2,
        'image3' => $imagePath3,
        'image4' => $imagePath4,
      ]);
      return redirect('/profile/'.auth()->user()->id.'/'.request('prefecture_id'));
    }

    public function destroy(Post $post) {
      $this->authorize('delete', $post);
      $preId = $post->prefecture_id;
      $imagePath = $post->image;
      $thumbnailPath = $post->thumbnail;
      Storage::disk('public')->delete([$imagePath, $thumbnailPath]);
      if($post->image2){
        $imagePath2 = $post->image2;
        Storage::disk('public')->delete($imagePath2);
      }
      if($post->image3){
        $imagePath3 = $post->image3;
        Storage::disk('public')->delete($imagePath3);
      }
      if($post->image4){
        $imagePath4 = $post->image4;
        Storage::disk('public')->delete($imagePath4);
      }
      $post->delete();
      return redirect('/profile/'.auth()->user()->id.'/'.$preId);
    }

}
