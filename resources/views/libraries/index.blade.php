@extends('layouts.main')


@section('link')
<link href="/css/library.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/pref.js"></script>
@endsection

@section('content')
<div class="container">

  <div class="d-flex mr-auto align-items-center mb-4" style="width: 80%;">
    <div class="pr-2">
      <a href="/profile/{{ $user->id }}" class="text-dark"><img src="/storage/{{ $user->image }}" class="rounded-circle w-100" style="max-width: 40px;"></a>
    </div>
    <div class="">
      <a class="text-dark" href="/profile/{{ $user->id }}">{{ $user->traveller_name }}のプロフィール</a>
    </div>
  </div>

  <div class="text-center">
    <h3><i class="fas fa-book pr-2"></i>{{ $user->traveller_name }}のライブラリ</h3>
  </div>

  @if($albums->count() === 0)
  <div class="text-center mt-5">
    <h2>ライブラリ登録されたアルバムがありません。</h2>
  </div>
  @else
  <div class="wrapper row mt-5">
    @foreach($albums as $album)
    <div class="col-12 row">
      <div class="offset-2 col-8 border-bottom d-flex align-items-center">
        <div class="pr-3">
          <a href="/profile/{{ $album->user->id }}" class="text-dark"><img src="/storage/{{ $album->user->image }}" class="rounded-circle w-100" style="max-width: 60px;"></a>
        </div>
        <div class="">
          <a href="/profile/{{ $album->user->id }}" class="text-dark">{{ $album->user->traveller_name }}</a>
        </div>
      </div>
    </div>
    <div class="album-wrapper offset-2 col-8 d-flex pb-5 pt-2 px-0">
      <a class="image w-25" href="/library/{{ $user->id }}/{{ $album->id }}">
        <div class="image-box">
          <div class="hover bg-dark"></div>
          <div class="hover data text-center p-5">
          </div>
          <img src="/storage/{{ $album->image }}" class="w-100">
        </div>
      </a>
      <div class="data-box px-5 pt-3 w-75">
        <div class="text-center"><h4><a class="text-dark" href="/library/{{ $user->id }}/{{ $album->id }}">- {{ $album->title }} -</a></h4></div>
        <div class="text-center"><p>{{ $album->caption }}</p></div>
        <div class="d-flex justify-content-center">
          <div class="px-2"><i class="pr-1 fas fa-lg fa-camera"></i>{{ $album->contents->count() }}</div>
          <div class="px-2"><i class="pr-1 fas fa-lg fa-comment"></i>{{ $album->comments->count() }}</div>
          <div class="px-2"><i class="pr-1 fas fa-lg fa-users"></i>{{ $album->subscribers->count() }}</div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif

</div>


@endsection
