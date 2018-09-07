@extends('layouts.app')

@section('content')
<?php $no=1; ?>
    <div class="container profile">
        <div class="cover row">
            <div class="col-lg-3 col-sm-6 mb-4">
                <img class="rounded img-fluid" src="{{ asset('images/'.Auth::user()->userinfo->cover) }}" alt="">
                <h4 class="py-1 text-secondary">{{ Auth::user()->name }}</h4>
                <p>Your Seller Code : <span class="text-danger">{{ Auth::user()->userinfo->seller_code }}</span></p>
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

                {{-- Overview Tab --}}
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="font-weight-bold">Owner Info <i class="fa fa-user fa-fw"></i></h5>
                            <table id="userinfo" class="table  table-striped table-sm">
                                <tr>
                                    <td class="header">Nama</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->name }}</th>
                                </tr>
                                <tr>
                                    <td class="header">Seller Code</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->seller_code }}</th>
                                </tr>
                                <tr>
                                    <td class="header">Gender</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->gender }}</th>
                                </tr>
                                <tr>
                                    <td class="header">Country</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->country }}</th>
                                </tr>
                                <tr>
                                    <td class="header">City</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->city }}</th>
                                </tr>
                                <tr>
                                    <td class="header">ZIP</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->zip }}</th>
                                </tr>
                                <tr>
                                    <td class="header">Address</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->address }}</th>
                                </tr>
                                <tr>
                                    <td class="header">Telp.</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->telp }}</th>
                                </tr>
                                <tr>
                                    <td class="header">Registered At</td>
                                    <td>:</td>
                                    <th>{{ Auth::user()->userinfo->created_at->toFormattedDateString() }}</th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">

                            {{-- latest auctions overview --}}
                            <h5 class="font-weight-bold mt-4 mt-md-0">Latest Auctions <i class="fa fa-feed fa-fw"></i></h5>
                            <div class="row">
                                <div class="list-group list-group-flush col">
                                    @if (count(Auth::user()->auctions) <= 0)
                                        <p class="text-center mt-1"><i class="fa fa-warning fa-fw text-danger"></i>There's no Auction found.</p>
                                    @else
                                        @foreach (Auth::user()->auctions()->latest()->limit(3)->get() as $auction)
                                            <a href="{{ route('auction.show', $auction) }}" class="list-group-item list-group-item-action">
                                                {{ $no++.'. '.str_limit($auction->name, 20) }}
                                                <small class="pull-right">{{ $auction->created_at->diffForHumans() }}</small>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            {{-- latest bid overview --}}
                            <?php $no=1;?>
                            <h5 class="font-weight-bold mt-3">Latest Bids <i class="fa fa-feed fa-fw"></i></h5>
                            <div class="row">
                                <div class="list-group list-group-flush col">
                                    @if (count(Auth::user()->userbids) <= 0)
                                        <p class="text-center mt-1"><i class="fa fa-warning fa-fw text-danger"></i>There's no Bid found.</p>
                                    @else
                                        @foreach (Auth::user()->userbids()->latest()->limit(2)->get() as $bid)
                                            <a href="{{ route('auction.show', $bid->auction) }}" class="list-group-item list-group-item-action">
                                                {{ $no++.'. Rp. '.number_format($bid->price, 0, '.', '.') }}
                                                <small class="pull-right">{{ $bid->created_at->diffForHumans() }}</small>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bidding Tab --}}
                <div class="tab-pane fade" id="bidding" role="tabpanel" aria-labelledby="bidding-tab">
                    <ul class="list-group">
                        @if (count(Auth::user()->auctions) == 0)
                            <h5 class="pt-4 text-center text-danger">There's no Bids found!.</h5>
                        @else
                            <h5 class="pt-4 font-weight-bold">Bid History<i class="fa fa-feed fa-fw"></i></h5>
                            @foreach (Auth::user()->userbids()->latest()->get() as $bid)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-1">
                                            <a href="{{ route('auction.show', $bid->auction) }}" class="text-dark">
                                                <img class="rounded img-fluid img-hover" src="{{ asset('images/'.$bid->auction->image) }}" alt="{{ $bid->auction->image }}">
                                            </a>
                                        </div>
                                        <div class="col-11">
                                            <p>
                                                {{ 'Rp. '.number_format($bid->price, 0, '.', '.') }} 
                                                <span class="font-weight-normal">On :</span> 
                                                <a class="text-dark" href="{{ route('auction.show', $bid->auction) }}">
                                                    {{ $bid->auction->name }}
                                                </a>
                                                <span class="pull-right"><small>{{ $bid->created_at->diffForHumans() }}</small></span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                {{-- Auction Tab --}}
                <div class="tab-pane fade" id="auction" role="tabpanel" aria-labelledby="auction-tab">
                    @if (count(Auth::user()->auctions) <= 0)
                        <h5 class="pt-4 text-center text-danger">There's no Auction found!.</h5>
                    @else
                        <h5 class="pt-4 font-weight-bold">Auction History<i class="fa fa-feed fa-fw"></i></h5>
                        <div class="row">
                            @foreach (Auth::user()->auctions as $auction)
                                <div class="row col-12 mb-2">
                                    <div class="col-3 col-sm-2 d-sm-block d-none">
                                        <a href="{{ route('auction.show', $auction) }}" class="text-dark">
                                            <img class="img-fluid rounded img-hover" src="{{ asset('images/'.$auction->image) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="col-9 col-sm-10 col-12">
                                        <a href="{{ route('auction.show', $auction) }}" class="text-dark">
                                            <h5 class="font-weight-bold">{{ $auction->name }} ( {{ $auction->size.'cm' }} )</h5>
                                        </a>
                                        <table class="table table-sm table-responsive table-striped">
                                            <tr>
                                                <td>Penawaran Tertinggi</td>
                                                <td>:</td>
                                                <th>{{ 'Rp. '.number_format($auction->higherBid(), 0, '.', '.') }}</th>
                                            </tr>
                                            <tr>
                                                <td>Deadline</td>
                                                <td>:</td>
                                                <th class="font-weight-bold">{{ $auction->deadline->toFormattedDateString() }}</th>
                                            </tr>
                                        </table>
                                    <span class="pull-right"><small>Published: {{ $auction->created_at->diffForHumans() }}</small></span>
                                    </div>
                                    <hr class="col-12">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
