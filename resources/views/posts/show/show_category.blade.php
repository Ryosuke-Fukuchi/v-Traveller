@extends('layouts.main')

@section('link')
<link href="/css/photo.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/photo.js"></script>
@endsection

@section('content')
<div class="container">

  <div class="mb-5 text-center">
    <a class="text-dark" href="/profile/{{ $post->user_id }}/{{ $post->prefecture_id }}">{{ $post->user->traveller_name }}の{{ $post->prefecture->pre}}一覧</a>
  </div>

  <div class="mb-4 text-center">
    <div class="h2"><i class="fas fa-hashtag"></i>{{ $post->category->name }}</div>
  </div>

  <div class="row mb-5">
    <div class=" offset-1 col-10 d-flex">
      @if($before)
      <a class="text-dark mr-auto" href="/p/{{ $before->category_id }}/{{ $before->id }}"><i class="fas fa-lg fa-angle-double-left"></i>次の投稿</a>
      @endif
      @if($after)
      <a class="text-dark ml-auto" href="/p/{{ $after->category_id }}/{{ $after->id }}">前の投稿<i class="fas fa-lg fa-angle-double-right"></i></a>
      @endif
    </div>
  </div>

 @if(isset($post->image2) || isset($post->image3) || isset($post->image4))
 <div class="row mb-2">
   <div class="col-8 text-center pr-5">
     <ul id="dot" class="m-0 list-unstyled d-flex justify-content-center">
       <li class="px-1"><i class="white far fa-circle"></i><i class="black fas fa-circle active"></i></li>
       @if($post->image2)
       <li class="px-1"><i class="white far fa-circle active"></i><i class="black fas fa-circle"></i></li>
       @endif
       @if($post->image3)
       <li class="px-1"><i class="white far fa-circle active"></i><i class="black fas fa-circle"></i></li>
       @endif
       @if($post->image4)
       <li class="px-1"><i class="white far fa-circle active"></i><i class="black fas fa-circle"></i></li>
       @endif
     </ul>
   </div>
   <div class="col-4">

   </div>
 </div>
 @endif

 <div class="row">

   <div class="col-8 row">
     <div class="col-1 d-flex align-items-center justify-content-center">
       @if(isset($post->image2) || isset($post->image3) || isset($post->image4))
       <i id="previous" class="fas fa-2x fa-angle-left arrow"></i>
       @endif
     </div>
     <div class="col-10">
       <ul class="p-0 m-0 list-unstyled" id="image-box">
         <li class="show"><img src="/storage/{{ $post->image }}" class="w-100"></li>
         @if($post->image2)
         <li><img src="/storage/{{ $post->image2 }}" class="w-100"></li>
         @endif
         @if($post->image3)
         <li><img src="/storage/{{ $post->image3 }}" class="w-100"></li>
         @endif
         @if($post->image4)
         <li><img src="/storage/{{ $post->image4 }}" class="w-100"></li>
         @endif
       </ul>
     </div>
     <div class="col-1 d-flex align-items-center justify-content-center">
       @if(isset($post->image2) || isset($post->image3) || isset($post->image4))
       <i id="next" class="fas fa-2x fa-angle-right arrow"></i>
       @endif
     </div>
   </div>

   <div class="wrap col-4 bg-white">

     <div class="d-flex align-items-center justify-content-between mb-3">
       <div class="pr-2">
         <img src="/storage/{{ $post->user->image }}" class="rounded-circle w-100" style="max-width: 50px;">
         <a class="font-weight-bold text-dark" href="/profile/{{$post->user->id}}">{{ $post->user->traveller_name }}</a>
       </div>
       @if($post->albums->count() > 0)
       <div class="">
         <a class="text-muted" href="#" data-toggle="modal" data-target="#modal2"><i class="far fa-lg fa-images pr-1"></i>所属アルバム</a>
       </div>
       @endif
     </div>

     <div class="h5 font-weight-bold text-center mt-3">
       {{ $post->title }}
     </div>

     <hr>

     <div class="pb-5 d-flex justify-content-between">
       <div class="">
         <star-button post-id="{{ $post->id }}" boolean="{{ $boolean }}" stars="{{ $post->gottenStars->count() }}"></star-button>
       </div>
       <div class="">
         <i class="fas fa-lg fa-hashtag"></i>
         @if($post->category_id)<a href="" class="text-dark category">{{ $post->category->name }}</a>@endif
       </div>
       <div class="">
         <i class="fa fa-lg fa-map-marked-alt pr-1"></i>{{ $post->city }}
       </div>
     </div>

     <div class="">{{ $post->caption }}</div>

     @can('delete', $post)
     <button type="button" class="delete btn btn-success" data-toggle="modal" data-target="#modal3">
       削除
     </button>

     <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#modal1">
       追加
     </button>
     @endcan

   </div>

 </div>

</div>

<div class="modal fade" id="modal1" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label1">アルバムに写真を追加する</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/add/{{ $post->category_id }}/{{ $post->id }}" method="post">
      <div class="modal-body">
        @csrf
        @if($albums)
        <div class="form-group pr-4">
          <label class="pr-2" for="album">アルバムを選択</label>
          <select class="form-control" id="album" name="album">
            @foreach($albums as $album)
            <option value="{{ $album->id }}">{{ $album->title }}</option>
            @endforeach
          </select>
        </div>
        @else
        <div class="">
          <p class="text-primary">追加できるアルバムがありません。</p>
        </div>
        @endif
        @if($added_albums)
        <div class="">
          <h5>追加されているアルバム</h5>
          <ul>
            @foreach($added_albums as $album)
            <li class="">{{ $album->title }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      @if($albums)
        <div class="modal-footer">
          <button class="btn btn-primary">追加</button>
        </div>
      @endif
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label1">所属アルバム</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled">
          @foreach($post->albums as $album)
          <li class="pt-2"><h5 class="">
            <a class="text-muted" href="/album/{{$album->user_id}}/{{$album->id}}"><i class="far fa-images pr-1"></i>{{$album->title}}</a>@if(Auth::User()) @if(Auth::User()->subscribing->contains($album->id))<i class="pl-2 fas fa-check"></i>@endif @endif
          </h5></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal3" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label1">写真の削除</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form action="/p/{{ $post->id}}" method="post">
          @csrf
          @method('DELETE')
          <button class="btn btn-success">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
