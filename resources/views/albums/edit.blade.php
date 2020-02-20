@extends('layouts.main')

@section('link')
<link href="/css/create.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
@endsection

@section('content')

<div class="container">

  <form action="/album/{{$album->id}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
      <div class="col-9 offset-1">

        <div class="row">
          <h1>Edit Album</h1>
        </div>

        <div class="row mb-4">
          <label for="image" class="col-md-4 col-form-label">Thumbnail</label>
          <input type="file" class="form-control-file" id="image" name="image">
          @error('image')
              <strong>{{ $message }}</strong>
          @enderror
        </div>

        <div class="form-group row">
          <label for="title" class="col-md-4 col-form-label">Album Title</label>
          <input id="title"
                  name="title"
                  type="text"
                  class="form-control @error('title') is-invalid @enderror"
                  value="{{ old('title') ?? $album->title }}"
                  autocomplete="title" autofocus>

          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="caption" class="col-md-4 col-form-label">Caption</label>
          <textarea id="caption" name="caption" class="form-control @error('caption') is-invalid @enderror" autocomplete="caption" placeholder="アルバムの説明">{{ old('caption') ?? $album->caption }}</textarea>

          @error('caption')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="row pt-5">
          <button class="btn btn-primary">Edit Album</buttom>
        </div>

      </div>
    </div>
  </form>

</div>

@endsection
