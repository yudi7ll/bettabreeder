@extends('layouts.app')

@section('content')
    <div class="container profile">
        <div class="cover row">
            <div class="col-lg-3 col-sm-6">
                <img class="rounded img-fluid" src="{{ asset('images/1.jpg') }}" alt="">
                <h4 class="py-1 text-secondary">{{ Auth::user()->name }}</h4>
                <a href="{{ route('profile.edit') }}" class="btn btn-dark font-weight-bold btn-sm py-2 mb-4 mt-1 col-12"><i class="fa fa-cogs"></i> Edit Profile</a>
            </div>
            <div class="col-lg-9">
                <ul class="nav nav-tabs" id="profileTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bidding-tab" data-toggle="tab" href="#bidding" role="tab" aria-controls="bidding" aria-selected="false">Bidding</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="auction-tab" data-toggle="tab" href="#auction" role="tab" aria-controls="auction" aria-selected="false">Auction</a>
                    </li>
                </ul>
                <div class="tab-content" id="profileTabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">

                </div>
                <div class="tab-pane fade" id="bidding" role="tabpanel" aria-labelledby="bidding-tab">
                    {{ $bidding }}
                </div>
                <div class="tab-pane fade" id="auction" role="tabpanel" aria-labelledby="auction-tab">...</div>
                </div>
            </div>
        </div>
    </div>
@endsection
