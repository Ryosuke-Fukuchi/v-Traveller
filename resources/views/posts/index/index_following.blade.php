@extends('layouts.main')


@section('link')
<link href="/css/index.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/index.js"></script>
@endsection

@section('content')
<div class="container">

  <div class="offset-9 col-2 mb-4">
    <a class="text-dark" href="/users"><h5>Search User<i class="pl-2 fas fa-users"></i></h5></a>
  </div>

  <nav class="pb-4">
    <ul class="list-unstyled d-flex justify-content-center bg-dark mx-auto" style="width: 35%; border-radius: 10px;">
      <li class="button m-3 text-center">
        <div class="font-weight-bold">
          <a class="text-muted" href="/">Posts</a>
        </div>
      </li>
      <li class="button m-3 text-center">
        <div class="font-weight-bold">
          <a class="text-muted" href="/albums">Albums</a>
        </div>
      </li>
      <li class="button m-3 text-center">
        <div class="font-weight-bold text-light">
          Following
        </div>
      </li>
    </ul>
  </nav>

  <div class="row">
    @foreach($followings as $following)
    <div class="post-box offset-3 col-6 mb-5 pt-3">
      <div class="d-flex justify-content-between align-items-end">
        <div class="d-flex align-items-center mb-1">
          <div class="pr-2">
            <a href="/profile/{{$following->user->id}}"><img src="/storage/{{ $following->user->image }}" class="rounded-circle w-100" style="max-width: 50px;"></a>
          </div>
          <a class="text-dark h5 m-0 font-weight-bold" href="/profile/{{$following->user->id}}">{{ $following->user->traveller_name }}</a>
        </div>
        <div class="h5">
          <i class="fa fa-map-marked-alt pr-1"></i>
          {{ $following->prefecture->pre }}@if($following->city):@endif {{ $following->city }}
        </div>
      </div>
      <a class="image" href="/post/{{ $following->id }}">
        <div class="image-box">
          <div class="hover bg-dark"></div>
          <div class="hover data text-center p-5">
            <h3 class="py-3">{{ $following->title }}</h3>
            <h4 class="py-3"><i class="far fa-star pr-1"></i>{{ $following->gottenStars->count() }}</h4>
            <div class="pt-3">
              @foreach($following->albums as $album)
              <h5 class="py-1"><i class="far fa-images pr-2"></i>: {{ $album->title }}</h5>
              @endforeach
            </div>
          </div>
          @if(isset($following->image2) || isset($following->image3) || isset($following->image4))
          <i class="layer fa-2x fas fa-clone text-light"></i>
          @endif
          <img src="/storage/{{ $following->thumbnail }}" class="w-100">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        @if($following->category_id)
        <div class="pl-2">
          <i class="fas fa-hashtag pr-1"></i>{{ $following->category->name }}
        </div>
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      {{ $followings->links() }}
    </div>
  </div>

</div>


@endsection
