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
        <div class="font-weight-bold text-light">
          Posts
        </div>
      </li>
      <li class="button m-3 text-center">
        <div class="font-weight-bold">
          <a class="text-muted" href="/albums">Albums</a>
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
    @foreach($posts as $post)
    <div class="post-box offset-3 col-6 mb-5 pt-3">
      <div class="d-flex justify-content-between align-items-end">
        <div class="d-flex align-items-center mb-1">
          <div class="pr-2">
            <a href="/profile/{{$post->user->id}}"><img src="/storage/{{ $post->user->image }}" class="rounded-circle w-100" style="max-width: 50px;"></a>
          </div>
          <a class="text-dark h5 m-0 font-weight-bold" href="/profile/{{$post->user->id}}">{{ $post->user->traveller_name }}</a>
        </div>
        <div class="h5">
          <i class="fa fa-map-marked-alt pr-1"></i>
          {{ $post->prefecture->pre }}@if($post->city):@endif {{ $post->city }}
        </div>
      </div>
      <a class="image" href="/post/{{ $post->id }}">
        <div class="image-box">
          <div class="hover bg-dark"></div>
          <div class="hover data text-center p-5">
            <h3 class="py-3">{{ $post->title }}</h3>
            <h4 class="py-3"><i class="far fa-star pr-1"></i>{{ $post->gottenStars->count() }}</h4>
            <div class="pt-3">
              @foreach($post->albums as $album)
              <h5 class="py-1"><i class="far fa-images pr-2"></i>: {{ $album->title }}</h5>
              @endforeach
            </div>
          </div>
          @if(isset($post->image2) || isset($post->image3) || isset($post->image4))
          <i class="layer fa-2x fas fa-clone text-light"></i>
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
    @endforeach
  </div>

  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      {{ $posts->links() }}
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

        <form action="/filter" method="post">
          @csrf
          <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control">
              <option value="" selected>#All</option>
              <option value="1">#Scenary</option>
              <option value="2">#Food</option>
              <option value="3">#Facility</option>
              <option value="4">#Event</option>
            </select>
          </div>

          <div class="form-group">
            <label for="prefecture">Prefecture</label>
            <select id="prefecture" name="prefecture" class="form-control">
              <option value="" selected>全国</option>
              <option value="1">北海道</option>
              <option value="2">青森県</option>
              <option value="3">岩手県</option>
              <option value="4">宮城県</option>
              <option value="5">秋田県</option>
              <option value="6">山形県</option>
              <option value="7">福島県</option>
              <option value="8">茨城県</option>
              <option value="9">栃木県</option>
              <option value="10">群馬県</option>
              <option value="11">埼玉県</option>
              <option value="12">千葉県</option>
              <option value="13">東京都</option>
              <option value="14">神奈川県</option>
              <option value="15">新潟県</option>
              <option value="16">富山県</option>
              <option value="17">石川県</option>
              <option value="18">福井県</option>
              <option value="19">山梨県</option>
              <option value="20">長野県</option>
              <option value="21">岐阜県</option>
              <option value="22">静岡県</option>
              <option value="23">愛知県</option>
              <option value="24">三重県</option>
              <option value="25">滋賀県</option>
              <option value="26">京都府</option>
              <option value="27">大阪府</option>
              <option value="28">兵庫県</option>
              <option value="29">奈良県</option>
              <option value="30">和歌山県</option>
              <option value="31">鳥取県</option>
              <option value="32">島根県</option>
              <option value="33">岡山県</option>
              <option value="34">広島県</option>
              <option value="35">山口県</option>
              <option value="36">徳島県</option>
              <option value="37">香川県</option>
              <option value="38">愛媛県</option>
              <option value="39">高知県</option>
              <option value="40">福岡県</option>
              <option value="41">佐賀県</option>
              <option value="42">長崎県</option>
              <option value="43">熊本県</option>
              <option value="44">大分県</option>
              <option value="45">宮崎県</option>
              <option value="46">鹿児島県</option>
              <option value="47">沖縄県</option>
            </select>
          </div>

          <div class="form-group">
            <label>Key Word</label>
            <input id="keyword" class="form-control" name="keyword" type="text">
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
