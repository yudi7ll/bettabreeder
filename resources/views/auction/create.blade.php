@extends('layouts.app')
@section('content')
    <div class="container home mt-4 bg-white col-lg-8">
        <h5 class="font-weight-bold py-4 text-md-center"><i class="fa fa-plus fa-fw fa-lg"></i>Create New Auction</h5>
       <div class="row">
            <form action="{{ route('auction.store') }}" class="col pb-4 mb-4" method="POST">
                @csrf
           
                {{-- Name --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">Betta Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
           
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
           
                {{-- Type --}}
                <div class="form-group row">
                    <label for="type" class="col-sm-4 col-form-label text-md-right">Type</label>
                    <div class="col-md-6">
                        <input type="text" id="type" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="type" value="{{ old('name') }}">
           
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
           
                {{-- Size --}}
                <div class="form-group row">
                    <label for="size" class="col-sm-4 col-form-label text-md-right">Size</label>
                    <div class="col-md-6">
                        <input type="number" id="size" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="size" value="{{ old('type') }}" placeholder="CM">
           
                        @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
           
                {{-- Age --}}
                <div class="form-group row">
                    <label for="age" class="col-sm-4 col-form-label text-md-right">Age</label>
                    <div class="col-md-6">
                        <input type="number" id="age" class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" name="age" value="{{ old('age') }}" placeholder="Berdasarkan Hari. Cth: 30">
                        
                        @if ($errors->has('age'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('age') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
           
                 {{-- Opening Price --}}
                <div class="form-group row">
                    <label for="opening_price" class="col-sm-4 col-form-label text-md-right">Opening Price</label>
                    <div class="col-md-6">
                        <input type="number" id="opening_price" class="form-control {{ $errors->has('opening_price') ? 'is-invalid' : '' }}" name="opening_price" value="{{ old('opening_price') }}" placeholder="Berdasarkan Hari. Cth: 30">
                        
                        @if ($errors->has('opening_price'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('opening_price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                 {{-- Start In --}}
                <div class="form-group row">
                    <label for="start_date" class="col-sm-4 col-form-label text-md-right">Start In</label>
                    <div class="col-md-6">
                        <input type="date" id="start_date" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" placeholder="Berdasarkan Hari. Cth: 30">
                        
                        @if ($errors->has('start_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                 {{-- Deadline --}}
                <div class="form-group row">
                    <label for="deadline" class="col-sm-4 col-form-label text-md-right">Deadline</label>
                    <div class="col-md-6">
                        <input type="date" id="deadline" class="form-control {{ $errors->has('deadline') ? 'is-invalid' : '' }}" name="deadline" value="{{ old('deadline') }}" placeholder="Berdasarkan Hari. Cth: 30">
                        
                        @if ($errors->has('deadline'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deadline') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-md-6 offset-md-4">
                        <button id="create-btn" type="submit" class="btn btn-primary col"><i class="fa fa-plus-square"></i> Create New Auction</button>
                    </div>
                </div>
            </form>
       </div>
    </div>
@endsection