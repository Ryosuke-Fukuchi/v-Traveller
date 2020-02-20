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

  <div class="row">
    <div class="offset-9 col-2" style="position: fixed; top: 150px; left: 0;">

      <div class="">
        @if(isset($keywords))
        <h4 class="py-2">
          <i class="fas fa-lg fa-search-plus pr-2"></i>
          <div class="keyword d-inline">
            @foreach($keywords as $keyword)
            <span class="">{{$keyword}}</span>
            @endforeach
          </div>
        </h4>
        @endif
      </div>

      <div class="my-4">
        <button class="btn btn-dark rounded-circle font-weight-bold" data-toggle="modal" data-target="#modal1" style="width: 70px; height: 70px;">
          <i class="fas fa-search"></i>Filter
        </button>
      </div>

    </div>
  </div>

  <nav class="pb-4">
    <ul class="list-unstyled d-flex justify-content-center bg-dark mx-auto" style="width: 35%; border-radius: 10px;">
      <li class="button m-3 text-center">
        <div class="font-weight-bold">
          <a class="text-muted" href="/">Posts</a>
        </div>
      </li>
      <li class="button m-3 text-center">
        <div class="font-weight-bold text-light">
          Albums
        </div>
      </li>
      <li class="button m-3 text-center">
        <div class="font-weight-bold">
          <a class="text-muted" href="/following">Following</a>
        </div>
      </li>
    </ul>
  </nav>

  <div class="row">
    @foreach($albums as $album)
    <div class="post-box offset-3 col-6 mb-5 pt-3">
      <div class="d-flex align-items-center mb-1">
        <div class="pr-2">
          <a href="/profile/{{$album->user->id}}"><img src="/storage/{{ $album->user->image }}" class="rounded-circle w-100" style="max-width: 50px;"></a>
        </div>
        <a class="text-dark h5 m-0 font-weight-bold" href="/profile/{{$album->user->id}}">{{ $album->user->traveller_name }}</a>
      </div>
      <a class="image" href="/album/{{ $album->user->id }}/{{ $album->id }}">
        <div class="image-box">
          <div class="hover bg-dark"></div>
          <div class="hover data text-center p-5">
            <h3 class="py-3">{{ $album->title }}</h3>
            <h5 class="py-3">{{ $album->caption }}</h5>
            <div class="h5 d-flex justify-content-center pt-3">
              <div class="px-2"><i class="pr-1 fas fa-lg fa-camera"></i>{{ $album->contents->count() }}</div>
              <div class="px-2"><i class="pr-1 fas fa-lg fa-comment"></i>{{ $album->comments->count() }}</div>
              <div class="px-2"><i class="pr-1 fas fa-lg fa-users"></i>{{ $album->subscribers->count() }}</div>
            </div>
          </div>
          <img src="/storage/{{ $album->image }}" class="w-100">
        </div>
      </a>
    </div>
    @endforeach
  </div>

  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      {{ $albums->links() }}
    </div>
  </div>

</div>

<div class="modal fade" id="modal1" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label1">Filter Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="/albums/filter" method="post">
          @csrf
        <div class="form-group">
          <label>Key Word</label>
          <input id="keyword" class="form-control" name="keyword" type="text" @if(isset($keywords)) value="@foreach($keywords as $keyword){{$keyword}} @endforeach" @endif>
        </div>

        <div class="text-center">
          <button class="btn btn-dark font-weight-bold" style="border-radius: 15px;">Search</button>
        </div>
       </form>

      </div>
    </div>
  </div>
</div>
@endsection
