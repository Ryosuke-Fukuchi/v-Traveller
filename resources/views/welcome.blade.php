@extends('layouts.main')

@section('link')
<link href="/css/welcome.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/welcome.js"></script>
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="head-container offset-2 col-8 mb-5">
      <div class="text-center p-5">
      </div>
      <div class="button-wrapper">
        <a href="/register">
          <div class="btn btn-primary button">
            新規登録
          </div>
        </a>
        <a href="/login">
          <div class="btn btn-success button">
            ログイン
          </div>
        </a>
      </div>
    </div>
  </div>


  <div class="row">

    <div class="content-wrapper w-100 offset-2 col-8 row">
      <div class="col-5">
        <div class="adjust-box">
          <div id="images" class="image">
          </div>
        </div>
      </div>
      <div class="col-7">
        <div class="pt-2">
          <h4 class="text-center py-1">「訪れた場所」</h4>
          <h4 class="text-center py-1">「見たもの」</h4>
          <h4 class="text-center py-1">「体験したこと」</h4>
          <h3 class="text-center py-2">マップに記録しよう!</h3>
        </div>
      </div>
    </div>

    <div class="content-wrapper w-100 offset-2 col-8 row">
      <div class="col-7">
        <div class="p-5">
          <h4 class="text-center">好きなテーマをアルバムに</h4>
          <h4 class="text-center">集めてシェアしよう！</h4>
          <h4 class="text-center pt-3">シェアされたアルバムを</h4>
          <h4 class="text-center">フォローしよう！</h4>
        </div>
      </div>
      <div class="col-5">
        <div class="adjust-box2">
          <div id="collage" class="image">
          </div>
        </div>
      </div>
    </div>

    <div class="content-wrapper w-100 offset-2 col-8 row">
      <div class="col-6">
        <div class="adjust-box3">
          <div id="map" class="image">
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="pt-5">
          <h3 class="text-center">日本全国を旅しよう！</h3>
        </div>
      </div>
    </div>

  </div>

  <div class="mx-auto row" style="width: 40%; margin-bottom: 110px;">

    <div class="category col-6">
      <div class="category-box d-flex align-items-center justify-content-center">
        <div id="register" class="category-wrap w-50 h-50 d-flex align-items-center justify-content-center rounded-circle" onclick="location.href='/register';">
          <div class="font-weight-bold">新規登録</div>
        </div>
      </div>
    </div>

    <div class="category col-6">
      <div class="category-box d-flex align-items-center justify-content-center">
        <div id="login" class="category-wrap w-50 h-50 d-flex align-items-center justify-content-center rounded-circle" onclick="location.href='/register';">
          <div class="font-weight-bold">ログイン</div>
        </div>
      </div>
    </div>

  </div>

  <div class="footer p-2">
    <div class="text-center mb-5">
      <h4>Mappy maintained by <a class="text-dark" href="https://www.facebook.com/profile.php?id=100011778532774" target="_blank">Ryosuke Fukuchi</a></h4>
    </div>
    <ul class="d-flex list-unstyled">
      <li>
        <p class="m-0 p-0">Copyright (c) 2020 Takemaru Hirai</p>
        <p class="m-0 p-0">Released under the MIT license</p>
        <a class="m-0 p-0" href="https://github.com/takemaru-hirai/japan-map/blob/master/LICENSE">github.com/takemaru-hirai/japan-map/blob/master/LICENSE</a>
      </li>
      <li>
        <p class="m-0 p-0">Copyright (c) 2020 pguso</p>
        <p class="m-0 p-0">Released under the MIT license</p>
        <a class="m-0 p-0" href="https://github.com/pguso/jquery-plugin-circliful/blob/master/LICENSE">github.com/pguso/jquery-plugin-circliful/blob/master/LICENSE</a>
      </li>
      <li>
        <p class="m-0 p-0">Copyright (c) 2020 Rewish</p>
        <p class="m-0 p-0">Released under the MIT license</p>
        <a class="m-0 p-0" href="https://github.com/rewish/jquery-bgswitcher/blob/master/LICENSE.md">github.com/rewish/jquery-bgswitcher/blob/master/LICENSE.md</a>
      </li>
    </ul>
  </div>

</div>

@endsection
