@extends('layouts.main')

@section('link')
<link href="/css/album_show.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/album.js"></script>
@endsection

@section('content')

<div class="container">

  <div class="">
    <a class="text-dark h5" onClick="history.back();" style="cursor: pointer;"><i class="fas fa-hand-point-left"></i> back</a>
  </div>

  <div class="d-flex mx-auto mb-5 align-items-center" style="width: 80%;">
    <div class="mr-auto">
      <a class="text-dark" href="/album/{{ $user->id }}">{{ $user->traveller_name }}のアルバム一覧<i class="far fa-lg fa-images pl-1"></i></a>
    </div>
    <div class="d-flex align-items-center ml-auto">
      <div class="pr-2">
        <a href="/profile/{{ $user->id }}" class="text-dark"><img src="/storage/{{ $user->image }}" class="rounded-circle w-100" style="max-width: 60px;"></a>
      </div>
      <div class="">
        <a href="/profile/{{ $user->id }}" class="text-dark">{{ $user->traveller_name }}</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="offset-3 col-6">
      <div class="d-flex align-items-center justify-content-center">
        <h1 class="text-center">- {{ $album->title }} -</h1>
        @if(\Auth::id() !== $user->id)
        <subscribe-button class="pl-3 text-danger" album-id="{{ $album->id }}" boolean="{{ $boolean }}"></subscribe-button>
        @endif
        @can('delete', $album)
        <div class="text-center pl-3"><a class="text-muted" data-toggle="modal" data-target="#modal2" href="#"><i class="fas fa-lg fa-trash-alt"></i></a></div>
        @endcan
      </div>
      <div class="pt-3">
        <p class="text-center m-0">{{ $album->caption }}</p>
        @can('update', $album)
        <div class="text-center mb-2">
          <a href="/album/{{$album->id}}/edit">Edit Album</a>
        </div>
        @endcan
        <div class="d-flex justify-content-center pt-1">
          <div class="px-2"><i class="pr-1 fas fa-lg fa-camera"></i>{{ $posts->count() }}</div>
          <div class="px-2"><i class="pr-1 fas fa-lg fa-comment"></i>{{ $album->comments->count() }}</div>
          <div class="px-2"><i class="pr-1 fas fa-lg fa-users"></i>{{ $album->subscribers->count() }}</div>
        </div>
      </div>
    </div>
  </div>


  <div class="tab mt-4">

    <ul id="tab-menu" class="nav nav-tabs w-75 mx-auto">
      <li class="nav-item"><a href="#" class="nav-link active" data-toggle="tab">Photos</a></li>
      <li class="nav-item"><a href="#" class="nav-link" data-toggle="tab">Comments</a></li>
    </ul>

    @if($posts->count() == 0)
    <div class="row pt-5">
      <div class="col-6 offset-3 text-center">
        <h2>アルバムの中身が空です。</h2>
      </div>
    </div>
    @else
    <ul id="tab_content">

      <li id="photos" class="show row pt-5 w-100">
          @foreach($posts as $post)
          <div class="post-box col-3 mb-4">
            <div class="post">
              <a class="image" href="/p/album/{{ $album->id }}/{{ $post->id }}">
                <div class="image-box">
                  <div class="hover bg-dark"></div>
                  <div class="hover data p-4">
                    <p>{{ $post->title }}</p>
                    <div class="h5">{{ $post->prefecture->pre }} : {{ $post->city }}</div>
                    <div class="h5"><i class="far fa-star pr-1"></i>{{ $post->gottenStars->count() }}</div>
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

      <li id="comments" class="comment w-100">
        <div class="w-75 mx-auto text-center py-4">
          {{ $comments->count() }}件のコメント
        </div>

        @if(\Auth::user())
        <comment class="w-75 mx-auto" profile-url="/profile/{{ \Auth::user()->id }}" img-src="/storage/{{ \Auth::user()->image }}" album-id="{{ $album->id }}" user-name="{{ \Auth::user()->traveller_name }}"></comment>
        @endif

        <ul class="list-unstyled w-75 mx-auto">
          @foreach($comments as $comment)
          <li class="border-bottom pt-4 pb-2">
            <div class="d-flex">
              <div class="" style="width: 10%;">
                <a href="/profile/{{ $comment->user_id }}" class="text-dark"><img src="/storage/{{ $comment->user->image }}" class="rounded-circle w-100"></a>
              </div>
              <div class="px-3" style="width: 90%;">
                <div class="font-weight-bold">{{ $comment->user->traveller_name }}</div>
                <div class="">{{ $comment->content }}</div>
                <div class="text-right pt-2">{{ $comment->created_at->format('Y-m-d') }}
                  @can('delete', $comment)
                  <button type="button" class="p-1 btn btn-dark" data-toggle="modal" data-target="#modal1">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  @endcan
                </div>
              </div>
            </div>
          </li>
          <div class="modal fade" id="modal1" tabindex="-1"
          role="dialog" aria-labelledby="label1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <form action="/comment/{{ $comment->id}}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="place" value="album">
                  <div class="modal-body">
                    <h3>コメントを削除しますか？</h3>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary">削除</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </ul>
      </li>

    </ul>
    @endif

  </div>


</div>

<div class="modal fade" id="modal2" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label1">アルバムを削除しますか？</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-end">
        <div class="w-25 p-0 m-0" data-toggle="modal" data-target="#modal2"><button data-toggle="modal" data-target="#modal3" class="btn btn-danger m-0 w-100 h-100">削除</button></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal3" tabindex="-1"
      role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="text-center">
        <h5 class="modal-title" id="label1">本当に削除しますか？</h5>
        <p class="m-0 pt-2">一度削除すると登録者やコメントは元に戻せません。</p>
      </div>
      <div class="modal-body d-flex justify-content-between">
        <form class="" action="/album/{{$album->id}}" method="post">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">削除</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
      </div>
    </div>
  </div>
</div>

@endsection
