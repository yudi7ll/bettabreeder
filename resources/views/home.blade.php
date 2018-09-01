@extends('layouts.app')

@section('content')
@include('side/right')

<div class="container home col-md-8">
    <div class="recent-articles">
        <div class="card px-3">
            <div class="d-flex justify-content-between mt-4 px-3">
                <div class="">
                    <h5 class=""><i class="fa fa-rss-square"></i> Recent Articles</h5>
                </div>
                <div class="">
                    <a href="#" class="">View All</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="card-body">
                    <div class="media">
                        <img class="align-self-top img-fluid mr-3 rounded thumbnail" src="{{ asset('images/1.jpg') }}" alt="" width="200px">
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold">
                                <a href="#">Lorem Ipsum</a>
                            </h5>
                            <small class="text-secondary">
                                <span class="mr-2">1 Hour Ago</span>
                                <i class="fa fa-eye"> 132</i>
                            </small>
                            <p>
                                Lorem ipsum dolor sit amet consectetur  elit. Nesciunt corporis, deleniti perspiciatis nobis tempora sequi ipsa inventore mollitia dolore at, ea reprehenderit excepturi vitae, voluptatum laborum. Tempore explicabo molestias et...
                                <a href="#">Read More.</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="featured-auction">
        <div class="card px-3 mt-4">
            <div class="d-flex justify-content-between mt-4 px-3">
                <div class="">
                    <h5 class=""><i class="fa fa-star"></i> Featured Auction</h5>
                </div>
                <div class="">
                    <a href="{{ route('auction.index') }}" class="">View All</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="card-body">
                    <div class="media">
                        <a href="#">
                            <img class="align-self-top img-fluid mr-3 rounded thumbnail" src="{{ asset('images/1.jpg') }}" alt="" width="200px">
                        </a>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold">
                                <a href="#">Halfmoon (10cm)</a>
                            </h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Owner : <strong>John Doe</strong>
                                </li>
                                <li class="list-group-item">
                                    Harga Pembuka : <strong>Rp. 210.000</strong>
                                </li>
                                <li class="list-group-item">
                                    Penawaran Tertinggi : <strong>Rp. 405.000</strong>
                                </li>
                                <li class="list-group-item list-group-item-info">
                                    Berakhir s/d : <strong>14 Sep, 2018</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="media">
                        <a href="#">
                            <img class="align-self-top img-fluid mr-3 rounded thumbnail" src="{{ asset('images/2.jpg') }}" alt="" width="200px">
                        </a>
                        <div class="media-body">
                            <h5 class="mt-0 font-weight-bold">
                                <a href="#">Fancy (8cm)</a>
                            </h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Owner : <strong>John Doe</strong>
                                </li>
                                <li class="list-group-item">
                                    Harga Pembuka : <strong>Rp. 210.000</strong>
                                </li>
                                <li class="list-group-item">
                                    Penawaran Tertinggi : <strong>Rp. 405.000</strong>
                                </li>
                                <li class="list-group-item list-group-item-info">
                                    Berakhir s/d : <strong>14 Sep, 2018</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
