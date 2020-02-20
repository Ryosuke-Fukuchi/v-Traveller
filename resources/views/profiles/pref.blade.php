@extends('layouts.main')

@section('link')
<link href="/css/pref.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/pref.js"></script>
@endsection

@section('content')

<div class="container">

  <div class="d-flex mx-auto align-items-center mb-5" style="width: 80%;">
    <div class="d-flex align-items-center mr-auto">
      <div class="pr-3">
        <a href="/profile/{{ $user->id }}" class="text-dark"><img src="/storage/{{ $user->image }}" class="rounded-circle w-100" style="max-width: 60px;"></a>
      </div>
      <div class="">
        <a href="/profile/{{ $user->id }}" class="text-dark">{{ $user->traveller_name }}</a>
      </div>
    </div>
    <div class="ml-auto">
      <a class="text-dark" href="/album/{{ $user->id }}">{{ $user->traveller_name }}のアルバム一覧<i class="far fa-lg fa-images pl-1"></i></a>
    </div>
  </div>

  <div class="row">
    <div class="offset-3 col-6">
      <h1 class="text-center">{{ $prefecture->pre }}<span class="h6 font-weight-normal"> (<i class="px-1 fas fa-camera"></i>{{ $posts->count() }})</span></h1>
    </div>
  </div>

  <div class="tab">

    <div id="tab_menu" class="row">

        <div class="category offset-1 col-2">
          <div class="category-box d-flex align-items-center justify-content-center">
            <div id="all" class="category-wrap w-50 h-50 d-flex align-items-center justify-content-center rounded-circle">
              <div class="category-word">#All</div>
            </div>
          </div>
        </div>
        <div class="category col-2">
          <div class="category-box d-flex align-items-center justify-content-center">
            <div id="scenary" class="category-wrap w-50 h-50 d-flex align-items-center justify-content-center rounded-circle active">
              <div class="category-word">#Scenary</div>
            </div>
          </div>
        </div>
        <div class="category col-2">
          <div class="category-box d-flex align-items-center justify-content-center">
            <div id="food" class="category-wrap w-50 h-50 d-flex align-items-center justify-content-center rounded-circle active">
              <div class="category-word">#Food</div>
            </div>
          </div>
        </div>
        <div class="category col-2">
          <div class="category-box d-flex align-items-center justify-content-center">
            <div id="facility" class="category-wrap w-50 h-50 d-flex align-items-center justify-content-center rounded-circle active">
              <div class="category-word">#Facility</div>
            </div>
          </div>
        </div>
        <div class="category col-2">
          <div class="category-box d-flex align-items-center justify-content-center">
            <div id="event" class="category-wrap w-50 h-50 d-flex align-items-center justify-content-center rounded-circle active">
              <div class="category-word">#Event</div>
            </div>
          </div>
        </div>
        @can('create', $user->profile)
        <div class="col-1 p-0 d-flex align-items-center">
          <a href="/p/{{ $prefecture->id }}/create" class="text-dark"><i class="fas fa-2x fa-plus-circle"></i></a>
        </div>
        @endcan


    </div>

    @if($posts->count() == 0)
    <div class="row pt-5">
      <div class="col-6 offset-3 text-center">
        <h2>まだ旅の記録がありません。</h2>
      </div>
    </div>
    @else
    <ul id="tab_content">

      <li class="show row pt-5">
          @foreach($posts as $post)
          <div class="post-box col-3 mb-4">
            <div class="post">
              <a class="image" href="/p/{{ $post->id }}">
                <div class="image-box">
                  <div class="hover bg-dark"></div>
                  <div class="hover data p-4">
                    <p>{{ $post->title }}</p>
                    <div class="d-flex justify-content-between">
                      <div class="h5">{{ $post->city }}</div>
                      <div class="h5"><i class="far fa-star pr-1"></i>{{ $post->gottenStars->count() }}</div>
                    </div>
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
      <li class="row pt-5">
          @foreach($scenaries as $scenary)
          <div class="post-box col-3 pb-4">
            <div class="">
              <a class="image" href="/p/{{ $scenary->category_id }}/{{ $scenary->id }}">
                <div class="image-box">
                  <div class="hover bg-dark"></div>
                  <div class="hover data p-5">
                    <p>{{ $scenary->title }}</p>
                    <div class="d-flex justify-content-between">
                      <div class="h5">{{ $scenary->city }}</div>
                      <div class="h5"><i class="far fa-star pr-1"></i>{{ $scenary->gottenStars->count() }}</div>
                    </div>
                  </div>
                  @if(isset($scenary->image2) || isset($scenary->image3) || isset($scenary->image4))
                  <i class="layer fa-lg fas fa-clone text-light"></i>
                  @endif
                  <img src="/storage/{{ $scenary->thumbnail }}" class="w-100">
                </div>
              </a>
              <div class="d-flex justify-content-end">
                @if($scenary->category_id)
                <div class="pl-2">
                  <i class="fas fa-hashtag pr-1"></i>{{ $scenary->category->name }}
                </div>
                @endif
              </div>
            </div>
          </div>
          @endforeach
      </li>
      <li class="row pt-5">
          @foreach($foods as $food)
          <div class="post-box col-3 pb-4">
            <div class="">
              <a class="image" href="/p/{{ $food->category_id }}/{{ $food->id }}">
                <div class="image-box">
                  <div class="hover bg-dark"></div>
                  <div class="hover data p-5">
                    <p>{{ $food->title }}</p>
                    <div class="d-flex justify-content-between">
                      <div class="h5">{{ $food->city }}</div>
                      <div class="h5"><i class="far fa-star pr-1"></i>{{ $food->gottenStars->count() }}</div>
                    </div>
                  </div>
                  @if(isset($food->image2) || isset($food->image3) || isset($food->image4))
                  <i class="layer fa-lg fas fa-clone text-light"></i>
                  @endif
                  <img src="/storage/{{ $food->thumbnail }}" class="w-100">
                </div>
              </a>
              <div class="d-flex justify-content-end">
                @if($food->category_id)
                <div class="pl-2">
                  <i class="fas fa-hashtag pr-1"></i>{{ $food->category->name }}
                </div>
                @endif
              </div>
            </div>
          </div>
          @endforeach
      </li>
      <li class="row pt-5">
          @foreach($facilities as $facility)
          <div class="post-box col-3 pb-4">
            <div class="">
              <a class="image" href="/p/{{ $facility->category_id }}/{{ $facility->id }}">
                <div class="image-box">
                  <div class="hover bg-dark"></div>
                  <div class="hover data p-5">
                    <p>{{ $facility->title }}</p>
                    <div class="d-flex justify-content-between">
                      <div class="h5">{{ $facility->city }}</div>
                      <div class="h5"><i class="far fa-star pr-1"></i>{{ $facility->gottenStars->count() }}</div>
                    </div>
                  </div>
                  @if(isset($facility->image2) || isset($facility->image3) || isset($facility->image4))
                  <i class="layer fa-lg fas fa-clone text-light"></i>
                  @endif
                  <img src="/storage/{{ $facility->thumbnail }}" class="w-100">
                </div>
              </a>
              <div class="d-flex justify-content-end">
                @if($facility->category_id)
                <div class="pl-2">
                  <i class="fas fa-hashtag pr-1"></i>{{ $facility->category->name }}
                </div>
                @endif
              </div>
            </div>
          </div>
          @endforeach
      </li>
      <li class="row pt-5">
          @foreach($events as $event)
          <div class="post-box col-3 pb-4">
            <div class="">
              <a class="image" href="/p/{{ $event->category_id }}/{{ $event->id }}">
                <div class="image-box">
                  <div class="hover bg-dark"></div>
                  <div class="hover data p-5">
                    <p>{{ $event->title }}</p>
                    <div class="d-flex justify-content-between">
                      <div class="h5">{{ $event->city }}</div>
                      <div class="h5"><i class="far fa-star pr-1"></i>{{ $event->gottenStars->count() }}</div>
                    </div>
                  </div>
                  @if(isset($event->image2) || isset($event->image3) || isset($event->image4))
                  <i class="layer fa-lg fas fa-clone text-light"></i>
                  @endif
                  <img src="/storage/{{ $event->thumbnail }}" class="w-100">
                </div>
              </a>
              <div class="d-flex justify-content-end">
                @if($event->category_id)
                <div class="pl-2">
                  <i class="fas fa-hashtag pr-1"></i>{{ $event->category->name }}
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


</div>
@endsection
