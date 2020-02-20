@extends('layouts.main')

@section('link')
<link href="/css/create.css" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="/js/create.js"></script>
@endsection

@section('content')

<div class="container">

  <form action="/p" enctype="multipart/form-data" method="post">
    @csrf
    <div class="row">
      <div class="col-9 offset-1">

        <div class="row">
          <h1>Add New Photo</h1>
        </div>

        <div class="row mb-4">
          <label for="image" class="col-md-4 col-form-label">Photo</label>
          <input type="file" class="form-control-file" id="image" name="image">
          @error('image')
              <strong>{{ $message }}</strong>
          @enderror
        </div>

        <div class="row d-flex align-items-center mb-4" style="height: 80px;">
          <div class="pr-3" id="open"><i id="right" class="toggle fas fa-lg fa-angle-double-right"></i></div>
          <div class="pr-3 none" id="close"><i id="left" class="toggle fas fa-lg fa-angle-double-left"></i></div>
          <div class="none" id="more">
            <ul class="d-flex">
              <li>
                <label for="image2" class="col-md-4 col-form-label">Photo</label>
                <input type="file" class="form-control-file" id="image2" name="image2">
                @error('image2')
                    <strong>{{ $message }}</strong>
                @enderror
              </li>
              <li>
                <label for="image3" class="col-md-4 col-form-label">Photo</label>
                <input type="file" class="form-control-file" id="image3" name="image3">
                @error('image3')
                    <strong>{{ $message }}</strong>
                @enderror
              </li>
              <li>
                <label for="image4" class="col-md-4 col-form-label">Photo</label>
                <input type="file" class="form-control-file" id="image4" name="image4">
                @error('image4')
                    <strong>{{ $message }}</strong>
                @enderror
              </li>
            </ul>
          </div>
        </div>


        <div class="form-inline">

          <div class="form-group pr-4">
            <label class="pr-3" for="prefecture_id">Prefecture</label>
            <div class="h4 m-0">
              {{ $prefecture->pre }}
            </div>
            <input type="hidden" name="prefecture_id" value="{{ $prefecture->id }}" id="prefecture_id">
          </div>

        	<div class="form-group pr-4">
        		<label class="pr-2" for="city">City</label>
        		<input type="text" class="form-control" id="city" name="city" placeholder="省略可"  value="{{ old('city') }}">
        	</div>
          <div class="form-group pr-4">
            <label class="pr-2" for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id">
              <option value=""></option>
              <option value="1" @if(old('category_id')=='1') selected  @endif>Scenary</option>
              <option value="2" @if(old('category_id')=='2') selected  @endif>Food</option>
              <option value="3" @if(old('category_id')=='3') selected  @endif>Facility</option>
              <option value="4" @if(old('category_id')=='4') selected  @endif>Event</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="title" class="col-md-4 col-form-label">Photo Title</label>
          <input id="title"
                  name="title"
                  type="text"
                  class="form-control @error('title') is-invalid @enderror"
                  value="{{ old('title') }}"
                  autocomplete="title" autofocus>

          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="caption" class="col-md-4 col-form-label">Caption</label>
          <textarea id="caption" name="caption" class="form-control @error('caption') is-invalid @enderror" autocomplete="caption" placeholder="省略可">{{ old('caption') }}</textarea>

          @error('caption')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="row pt-5">
          <button class="btn btn-primary">Add</buttom>
        </div>

      </div>
    </div>
  </form>

</div>

@endsection
