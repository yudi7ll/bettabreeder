@extends('layouts.app')
@section('content')
@include('side.right')

<?php $no=1; ?>
<div class="container home mt-3">
    <div class="auction-show">
        <ul class="list-unstyled">
            <li class="media mb-4">
                <figure class="figure">
                    <img src="{{ asset('images/1.jpg') }}" class="mr-3 thumbnail figure-img img-fluid rounded" alt="{{ $auction->name }}">
                    <figcaption class="figure-caption"><i class="fa fa-eye"></i> 539</figcaption>
                </figure>
                <div class="media-body">
                    <h3 class="mt-0 mb-1 font-weight-bold">
                        {{ $auction->name }} ({{ $auction->size }} cm)
                    </h3>
                    <table class="table">
                        <tr>
                            <td>Owner</td>
                            <th>:</th>
                            <th>
                                <strong>{{ $auction->seller()->name }}</strong>
                            </th>
                        </tr>
                        <tr>
                            <td>Product Code</td>
                            <th>:</th>
                            <th>
                                {{ $auction->product_code }}
                            </th>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <th>:</th>
                            <th>
                                {{ $auction->size.' cm' }}
                            </th>
                        </tr>
                        <tr>
                            <td>Umur Ikan</td>
                            <th>:</th>
                            <th>
                                {{ $auction->age.' Hari' }}
                            </th>
                        </tr>
                        <tr>
                            <td>Harga Pembuka</th>
                            <th>:</th>
                            <th>
                                <strong>Rp. {{ number_format($auction->opening_price, 0, '.','.') }}</strong>
                            </th>
                        </tr>
                        <tr>
                            <td>Penawaran Tertinggi</th>
                            <th>:</th>
                            <th>
                                <strong>
                                    Rp. {{ isset($auction->higherBid()->price) ? number_format($auction->higherBid()->price, 0, '.', '.') : '' }}
                                </strong>
                                <button type="button" class="btn btn-link btn-sm fa fa-history text-primary pull-right p-0" data-toggle="collapse" data-target="#bidHistory" aria-control="bidHistory" title="Riwayat Penawaran"></button>
                                <ul class="list-group list-group-flush collapse pt-3" id="bidHistory">
                                    @foreach ($auction->bids()->get() as $bid)
                                        <li class="list-group-item list-group-item-light">
                                            {{ $no++.'. Rp. '.number_format($bid->price, 0,'.','.') }}
                                            <small class="pull-right">{{ $bid->created_at->diffForHumans() }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </th>
                        </tr>
                        <tr class="table-primary">
                            <td>Berakhir s/d</td>
                            <th>:</th>
                            <th>
                                <strong id="date" data-date="{{ $auction->deadline }}">{{ $auction->deadline->format('H.i - d M, Y') }} WIB</strong>
                            </th>
                        </tr>
                    </table>
                    <ul class="list-group collapse mt-4 bg-secondary p-4 rounded" id="place-bid">
                        <form action="{{ route('bid') }}" class="form-group">
                            @csrf
                            @method('PUT')
                            <input type="number" name="bid" class="form-control" placeholder="Your bid...">
                            <button type="submit" class="btn btn-success mt-1 btn-sm"><i class="fa fa-send fa-fw"></i> Send bid</button>
                            @guest
                                <small class="text-light">You must be <a href="{{ route('login') }}" class="text-danger">login</a> before placing bid</small>
                            @endguest
                        </form>
                    </ul>
                    <div class="bot mt-4 d-flex justify-content-between">
                        <button class="btn btn-success" data-toggle="collapse" data-target="#place-bid" aria-control="place-bid"><i class="fa fa-plus-circle fa-fw"></i> Place Bid</button>
                        <h6 class="text-danger font-weight-bold" id="countDownTime"></h6>
                    </div>
                </div>
            </li>
        </ul>

        <hr class="p-4 mb-1">

        {{-- comment section --}}
        <div class="owner-info row col-lg-12">
            <div class="col-lg-6 order-lg-1 order-3 comment">
                <h5 class="font-weight-bold">Comment (2)</h5>
                <form>
                    <div class="form-group">
                        <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Your comment here...">{{ old('comment') }}</textarea>
                        @guest
                            <small class="pull-right mt-1">Your comment will send after you <a href="#">login</a></small>
                        @endguest
                        <button type="submit" class="fa fa-send btn btn-primary btn-sm my-2"> Send</button>
                    </div>
                </form>
                <div class="border-top p-3">
                    <span class="font-weight-bold">John Doe</span>
                    <small class="text-secondary ml-2">15 Aug, 2018</small>
                    <p>Isi dari komen section</p>
                    <small class="p-0 m-0">
                        <a href="#">Reply</a>
                    </small>
                </div>
                <div class="border-top p-3">
                    <span class="font-weight-bold">John Doe</span>
                    <small class="text-secondary ml-2">15 Aug, 2018</small>
                    <p>Isi dari komen section</p>
                    <small class="p-0 m-0">
                        <a href="#">Reply</a>
                    </small>
                </div>
            </div>

            {{-- offset --}}
            <div class="col-lg-1 order-2"></div>

            {{-- owner info --}}
            <div class="col-lg-5 col-md-8 order-lg-3 order-1 pull-right border py-4 border-info rounded mb-4">
                <h4 class="font-weight-bold text-center pb-1">Owner Info</h4>
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->name }}</th>
                    </tr>
                    <tr>
                        <td>Seller Code</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->seller_code }}</th>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->gender }}</th>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->country }}</th>
                    </tr>
                    <tr>
                        <td>City</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->city }}</th>
                    </tr>
                    <tr>
                        <td>ZIP</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->zip }}</th>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->address }}</th>
                    </tr>
                    <tr>
                        <td>Telp.</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->telp }}</th>
                    </tr>
                    <tr>
                        <td>Registered At</td>
                        <th>:</th>
                        <th>{{ $auction->seller()->userinfo()->created_at->toFormattedDateString() }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



<script>

// time countCown
var el = $('#date').data('date');
var countDownDate = new Date(el).getTime();
setInterval(function(){
    var now = new Date().getTime();
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    var hari = days + ' Hari ';
    var jam = hours + ' Jam ';
    var menit = minutes + ' Menit ';
    var sec = seconds + 's';

    days <= 0 ? hari = '' : '';
    days != 0 ? seconds = '' : '';
    days != 0 ? menit = '' : '';
    hours <= 0 ? jam = '' : '';
    minutes <= 0 ? menit = '' : '';
    seconds <= 0 ? sec = '' : '';

    document.getElementById("countDownTime").innerHTML = '<span class="text-dark">Sisa Waktu : </span>' + hari + jam + menit + sec;
}, 1000);

</script>
@endsection
