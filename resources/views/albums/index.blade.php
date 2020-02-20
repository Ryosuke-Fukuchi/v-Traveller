@extends('layouts.main')


@section('link')
<link href="/css/album.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/pref.js"></script>
@endsection

@section('content')
<div class="container">

  <div class="d-flex mx-auto align-items-center mb-4" style="width: 80%;">
    <div class="d-flex align-items-center mr-auto">
      <div class="pr-2">
        <a href="/profile/{{ $user->id }}" class="text-dark"><img src="/storage/{{ $user->image }}" class="rounded-circle w-100" style="max-width: 60px;"></a>
      </div>
      <div class="">
        <a href="/profile/{{ $user->id }}" class="text-dark">{{ $user->traveller_name }}のプロフィール</a>
      </div>
    </div>
  </div>

  @if($user->albums->count() > 0)
  <div class="">
    <div class="mb-4 text-center">
      <h2><i class="far fa-images pr-2"></i>{{ $user->traveller_name }}のアルバム</h2>
    </div>
  </div>
  @endif

  @can('create', $user->profile)
  <div class="text-center mb-5">
    <a class="text-success" href="/album/create"><i class="fas fa-2x fa-plus-circle"></i></a>
  </div>
  @endcan

  @if($user->albums->count() === 0)
  <div class="text-center">
    <h2>{{ $user->traveller_name }}のアルバムはまだありません。</h2>
  </div>
  @else
  <div class="wrapper row mt-5">
    @foreach($user->albums as $album)
    <div class="album-wrapper offset-2 col-8 d-flex justify-content-between py-4 border-bottom">
      <a class="image w-50" href="/album/{{ $album->user_id }}/{{ $album->id }}">
        <div class="image-box">
          <div class="hover bg-dark"></div>
          <div class="hover data text-center p-5">
          </div>
          <img src="/storage/{{ $album->image }}" class="w-100">
        </div>
      </a>
      <div class="data-box pt-5">
          <div class="text-center"><h4><a class="text-dark" href="/album/{{ $album->user_id }}/{{ $album->id }}">- {{ $album->title }} -</a></h4></div>
          <div class="text-center"><p>{{ $album->caption }}</p></div>
          <div class="d-flex justify-content-center pt-3">
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
