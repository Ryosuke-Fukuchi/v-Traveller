@extends('layouts.main')

@section('content')

<div class="container">

  <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
      <div class="col-8 offset-2">

        <div class="row">
          <h1>Edit Profile</h1>
        </div>

        <div class="row pb-2">
          <label for="image" class="col-md-4 col-form-label">Profile Image</label>
          <input type="file" class="form-control-file" id="image" name="image" value="">
          @error('image')
              <strong>{{ $message }}</strong>
          @enderror
        </div>

        <div class="form-group row">
          <label for="traveller_name" class="col-md-4 col-form-label">Traveller Name</label>
          <input id="traveller_name"
          name="traveller_name"
          type="text"
          class="form-control @error('traveller_name') is-invalid @enderror"
          value="{{ old('traveller_name') ?? $user->traveller_name }}"
          autocomplete="traveller_name" autofocus>

          @error('traveller_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="description" class="col-md-4 col-form-label">Description</label>
          <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus>{{ old('description') ?? $user->profile->description }}</textarea>

          @error('description')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="facebook" class="col-md-4 col-form-label">Facebook</label>
          <input id="facebook"
          name="facebook"
          type="text"
          class="form-control @error('facebook') is-invalid @enderror"
          value="{{ old('facebook') ?? $user->profile->facebook }}"
          autocomplete="facebook" autofocus>

          @error('facebook')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="instagram" class="col-md-4 col-form-label">Instagram</label>
          <input id="instagram"
          name="instagram"
          type="text"
          class="form-control @error('instagram') is-invalid @enderror"
          value="{{ old('instagram') ?? $user->profile->instagram }}"
          autocomplete="instagram" autofocus>

          @error('instagram')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="twitter" class="col-md-4 col-form-label">Twitter</label>
          <input id="twitter"
          name="twitter"
          type="text"
          class="form-control @error('twitter') is-invalid @enderror"
          value="{{ old('twitter') ?? $user->profile->twitter }}"
          autocomplete="twitter" autofocus>

          @error('twitter')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="row pt-5">
          <button class="btn btn-primary">Edit Profile</buttom>
        </div>

      </div>
    </div>
  </form>

</div>

@endsection
