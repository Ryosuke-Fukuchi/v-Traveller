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
    <h4><a class="text-dark" href="/library/{{ $user->id }}/{{ $album->id }}"><i class="far fa-images pr-1"></i>{{$album->title}}</a></h4>
  </div>

  <div class="row mb-5">
    <div class=" offset-1 col-10 d-flex">
      @if($before)
      <a class="text-dark mr-auto" href="/p/library/{{ $user->id }}/{{ $album->id }}/{{ $before->id }}"><i class="fas fa-lg fa-angle-double-left"></i>次の投稿</a>
      @endif
      @if($after)
      <a class="text-dark ml-auto" href="/p/library/{{ $user->id }}/{{ $album->id }}/{{ $after->id }}">前の投稿<i class="fas fa-lg fa-angle-double-right"></i></a>
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

     <div class="d-flex align-items-center mb-3">
       <div class="pr-2">
         <img src="/storage/{{ $post->user->image }}" class="rounded-circle w-100" style="max-width: 50px;">
       </div>
       <div class="font-weight-bold">
         <a class="text-dark" href="/profile/{{$post->user->id}}">{{ $post->user->traveller_name }}</a>
       </div>
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

   </div>

 </div>


</div>



@endsection
