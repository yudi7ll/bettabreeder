@extends('layouts.app')
@section('content')
@include('side.left')

<div class="container home col-md-8 bg-white">
    <div class="auction-list">
        <h5 class="pt-4">
            <i class="fa fa-gavel"></i> Newest Auctions
            <a href="{{ route('auction.create') }}" class="btn btn-dark font-weight-bold pull-right btn-sm px-3 text-light"><i class="fa fa-plus"></i> Create</a>
        </h5>
        @foreach ($auctions as $auction)
            <div class="row mb-4">
                <div class="col-sm-4 d-flex align-items-center">
                    <a href="{{ route('auction.show', $auction) }}">
                        <img class="rounded img-fluid img-hover" src="{{ asset('images/'.$auction->image) }}" alt="{{ $auction->image }}"">
                    </a>
                </div>    
                <div class="col-sm-8 mt-4">
                    <a href="{{ route('auction.show', $auction) }}" class="text-dark">
                        <h5 class="font-weight-bold">{{ $auction->name }} ( {{ $auction->size.'cm' }} )</h5>
                    </a>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Owner : <strong>{{ $auction->seller->name }}</strong>
                        </li>
                        <li class="list-group-item">
                            Harga Pembuka : <strong>Rp. {{ number_format($auction->opening_price, 0, '.','.') }}</strong>
                        </li>
                        <li class="list-group-item">
                            Penawaran Tertinggi : <strong>Rp. {{ '' }}</strong>
                        </li>
                        <li class="list-group-item list-group-item-info">
                            Berakhir s/d : <strong>{{ $auction->deadline->toFormattedDateString() }}</strong>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
