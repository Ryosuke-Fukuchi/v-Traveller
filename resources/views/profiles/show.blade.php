@extends('layouts.main')


@section('link')
<link href="/css/jquery.circliful.css" rel="stylesheet" type="text/css">
<link href="/css/profile.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/main.js"></script>
@endsection

@section('content')
<div class="container">

  <div id="wrap">
    <div class="d-flex w-75 mx-auto">
      <div id="tab1" class="tab selected">Profile</div>
      <div id="tab2" class="tab">Data</div>
      <div id="tab3" class="tab">Albums</div>
      <div id="tab4" class="tab">SNS</div>
    </div>

    <div id="container">
      <div id="slide" class="">
        <div id="first" class="box">
          <div class="px-1 py-5">
            <div class="d-flex w-100">
              <img src="/storage/{{ $user->image }}" class="rounded-circle w-25">
              <div class="pl-5 w-75">
                <div class="d-flex align-items-center">
                  <h5 class="py-1 m-0 font-weight-bold">{{ $user->traveller_name }}
                  </h5>
                  @can('update', $user->profile)
                  <a class="text-muted" href="/profile/{{ $user->id }}/edit"><i class="pl-1 fas fa-cog"></i></a>
                  @endcan
                </div>
                <p class="m-0">{{ $user->profile->description }}</p>
              </div>
            </div>
          </div>
        </div>

        <div id="second" class="box">
          <div class="d-flex justify-content-center w-100 py-5">
            <div class="pt-2 px-3">
              <h4><strong class="pr-1">{{ $fans }}</strong> Fans<i class="pl-1 fas fa-user-friends"></i></h4>
            </div>
            <div class="pt-2 px-3">
              <h4><strong class="pr-1">{{ $stars }}</strong> Stars<i class="pl-1 fas fa-star"></i></h4>
            </div>
            <div class="pt-2 px-3">
              <h4><strong class="pr-1">{{ $user->posts->count() }}</strong> Posts<i class="pl-1 fas fa-camera"></i></h4>
            </div>
          </div>
        </div>

        <div id="third" class="box">
          <div class="d-flex justify-content-center w-100 p-5">
            <div class="pt-2 px-3">
              <h4><strong class="pr-1">{{ $user->albums->count() }}</strong> <a class="text-dark" href="/album/{{ $user->id }}">Albums<i class="far fa-images pl-1"></i></a></h4>
            </div>
            <div class="pt-2 px-3">
              <h4><strong class="pr-1">{{ $user->subscribing->count() }}</strong> <a class="text-dark" href="/library/{{ $user->id }}">in Library<i class="fas fa-book pl-1"></i></a></h4>
            </div>
          </div>
        </div>

        <div id="four" class="box">
          <div class="d-flex justify-content-center w-100 p-5">
            <div class="pt-2 px-4"><a class="text-muted" href="{{ $user->profile->facebook }}" target="_blank"><i class="fab fa-facebook-square fa-3x"></i></a></div>
            <div class="pt-2 px-4"><a class="text-muted" href="{{ $user->profile->instagram }}" target="_blank"><i class="fab fa-instagram fa-3x"></i></a></div>
            <div class="pt-2 px-4"><a class="text-muted" href="{{ $user->profile->twitter }}" target="_blank"><i class="fab fa-twitter fa-3x"></i></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="d-flex mx-auto" style="width: 80%">
    <div class="w-75 text-center">
      <h4>訪れた都道府県: {{ $havebeen }}</h4>
    </div>
    <div class="w-25">
      @can('view', $user->profile)
      <h4><a class="text-warning" href="/stars/{{$user->id}}"><i class="pr-1 fas fa-star"></i>My Stars</a></h4>
      @endcan
    </div>
  </div>


  <div class="main-container d-flex mx-auto" style="width: 80%">
    <div id="map-container" class="w-75">
      <div id="map" data-id="{{ $user->id }}" data-pre="{{ $pre_data }}"></div>
      <h4 id="text" class="m-0 p-2 text-center" data-photos="{{ $photos }}"></h4>
    </div>
    <div class="data-container w-25">
      <div class="user-data">
        <div class="data" id="circle" data-percent="{{$japan_late}}"></div>
      </div>
      <div class="user-data">
        <canvas class="data" id="myChart" width="1" height="1" data-hokkaido="{{$hokkaido_late}}" data-tohoku="{{$tohoku_late}}" data-kanto="{{$kanto_late}}" data-chubu="{{$chubu_late}}" data-chugoku="{{$chugoku_late}}" data-shikoku="{{$shikoku_late}}" data-kinki="{{$kinki_late}}" data-kyushu="{{$kyushu_late}}">
      </div>
      <div class="score-box">
        <div class="pt-5 text-center score">
          <p>- Traveller Score -</p>
          <div class="">旅人</div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
