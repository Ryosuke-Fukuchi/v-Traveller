@extends('layouts.main')

@section('link')
<link href="/css/pref.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/pref.js"></script>
@endsection

@section('content')

<div class="container">


  <div class="row my-4">
    <div class="offset-3 col-6">
      <h1 class="text-center"><i class="pr-2 fas fa-star"></i>My Stars<span class="h6 font-weight-normal"> (<i class="px-1 fas fa-camera"></i>{{ $posts->count() }})</span></h1>
    </div>
  </div>

  <div class="tab">

    @if($posts->count() == 0)
    <div class="row pt-5">
      <div class="col-6 offset-3 text-center">
        <h2>まだスターした投稿がありません。</h2>
      </div>
    </div>
    @else
    <ul id="tab_content">

      <li class="show row pt-5">
          @foreach($posts as $post)
          <div class="post-box col-2 mb-4">
            <div class="post">
              <a class="image" href="/p/stars/{{ $user->id }}/{{ $post->id }}">
                <div class="image-box">
                  <div class="hover bg-dark"></div>
                  <div class="hover data p-3">
                    <p>{{ $post->title }}</p>
                  </div>
                  @if(isset($post->image2) || isset($post->image3) || isset($post->image4))
                  <i class="layer fa-lg fas fa-clone text-light"></i>
                  @endif
                  <img src="/storage/{{ $post->thumbnail }}" class="w-100">
                </div>
              </a>
              <div class="d-flex justify-content-end">
                @if($post->category_id)
                <div class="pl-2">
                  <i class="fas fa-hashtag pr-1"></i>{{ $post->category->name }}
                </div>
                @endif
              </div>
            </div>
          </div>
          @endforeach
      </li>
    </ul>
    @endif

  </div>


  <div class="row">
    <div class="col-12 d-flex justify-content-center">

    </div>
  </div>

</div>
@endsection
