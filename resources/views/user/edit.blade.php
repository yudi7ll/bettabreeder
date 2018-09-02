@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>

    <div class="container profile">
        <div class="cover row">
            <div class="col-lg-8 order-lg-1  order-3">
                <h4 class="font-weight-bold">Public Profile</h4>
                <hr>
                <div class="container">
                    <form method="POST" action="{{ route('profile.update') }}" aria-label="{{ __('Edit Profile') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                            <div class="col-md-6">
                                <select class="custom-select" name="gender" id="gender">
                                    <option>Select Gender...</option>
                                    <option {{ $user->userinfo()->gender == "Man" ? 'selected' : '' }}>Man</option>
                                    <option {{ $user->userinfo()->gender == "Female" ? 'selected' : '' }}>Female</option>
                                    <option {{ $user->userinfo()->gender == "Superman" ? 'selected' : '' }}>Superman</option>
                                    <option {{ $user->userinfo()->gender == "Batman" ? 'selected' : '' }}>Batman</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" value="{{ $user->userinfo()->address }}">

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" id="city" name="city" value="{{ $user->userinfo()->city }}">

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}" id="zip" name="zip" value="{{ $user->userinfo()->zip }}" placeholder="Zip">

                                @if ($errors->has('zip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" id="country" name="country" value="{{ $user->userinfo()->country }}">

                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telp" class="col-md-4 col-form-label text-md-right">Telp. Number</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control {{ $errors->has('telp') ? 'is-invalid' : '' }}" id="telp" name="telp" value="{{ $user->userinfo()->telp }}">

                                @if ($errors->has('telp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark font-weight-bold">
                                    <i class="fa fa-save"></i>
                                    {{ __(' Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-1 order-2"></div>
            <div class="col-lg-3 order-1 col-md-6 col-sm-8">
                <h4 class="py-1 font-weight-bold">Profile Picture</h4>
                <div id="cropping">
                    <img class="rounded img-fluid" src="{{ asset('images/1.jpg') }}" alt="">
                </div>
                <div class="profile-picture">
                    <form action="{{ route('profile.cover') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="cover" id="cover" class="d-none">
                        <button type="button" id="upload-btn" onclick="document.getElementById('cover').click();" class="btn btn-dark font-weight-bold btn-sm py-2 mb-4 mt-1 col-12"><i class="fa fa-upload"></i> Upload New Photo</button>
                        <button type="button" id="do-upload" class="d-none btn btn-dark font-weight-bold btn-sm py-2 mb-4 mt-1 col-12"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>

    $(window).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // change the button
        $('#upload-btn').click(function(){
            $('#do-upload').removeClass('d-none');
            $(this).hide();
        });

        // cropping

        $('#cover').on('change', function () { 
            // reset the img src attr
            $('#cropping img').removeAttr('src');
            // cropping setup
            $uploadCrop = $('#cropping img').croppie({
                boundary:{
                    height: 200
                },
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                }
            });

            // render preview
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(this.files[0]);
        });    
        
        // upload to database
        $('#do-upload').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: $('form').attr('action'),
                    type: "POST",
                    data: {'cover':resp},
                    success: function (data) {
                        console.log('ok');
                    },
                    error: function(){
                        console.log('Error');
                    }
                });
            });
        });
    });
</script>
@endsection