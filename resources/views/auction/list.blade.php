@extends('layouts.app')
@section('content')
@include('side.right')

<div class="container home col-md-8 bg-white">
    <div class="auction-list">
        <h5 class="pt-4"><i class="fa fa-gavel"></i> Newest Auctions</h5>
        <hr>
        <ul class="list-unstyled">
            @foreach ($auctions as $auction)
                <li class="media mb-4">
                    <a id="app2" href="{{ route('auction.show', $auction) }}" v-bind:title="message">
                        <img class="mr-3 thumbnail" src="{{ asset('images/1.jpg') }}" alt="Generic placeholder image">
                    </a>
                    <div class="media-body">
                    <h5 class="mt-0 mb-1">
                        <a class="font-weight-bold" href="{{ route('auction.show', $auction) }}">{{ $auction->name }} ({{ $auction->size }})</a>    
                    </h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Owner : <strong>{{ $auction->seller()->name }}</strong>
                            </li>
                            <li class="list-group-item">
                                Harga Pembuka : <strong>Rp. {{ number_format($auction->opening_price, 0, '.','.') }}</strong>
                            </li>
                            <li class="list-group-item">
                                Penawaran Tertinggi : <strong>Rp. {{ '' }}</strong>
                            </li>
                            <li class="list-group-item list-group-item-info">
                                Berakhir s/d : <strong>{{ $auction->created_at->toFormattedDateString() }}</strong>
                            </li>
                        </ul>
                    </div>
                </li>
                <hr class="pt-4">
            @endforeach
        </ul>
    </div>
</div>
@endsection
