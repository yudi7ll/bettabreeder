@extends('layouts.app')
@section('content')

<?php $no=1; ?>
<div class="container home mt-3">
    <div class="auction-show">
            <div class="row mb-4">
                    <div class="col-md-4 offset-md-1 col-lg-3 offset-lg-1 d-flex align-items-center">
                        <figure class="figure">
                            <img src="{{ asset('images/'.$auction->image) }}" class="mr-3 figure-img img-fluid rounded" alt="{{ $auction->name }}">
                            <figcaption class="figure-caption pull-right text-danger" id="countDownTime"></figcaption>
                        </figure>
                    </div>    
                    <div class="col-md-7 col-lg-7 mt-4">
                        <h5 class="font-weight-bold">
                            {{ $auction->name }} ( {{ $auction->size.'cm' }} ) 
                            <small class="pull-right"><i class="fa fa-eye"></i> {{ $auction->seen }}</small>
                        </h5>
                        <table class="table">
                            <tr>
                                <td>Owner</td>
                                <th>:</th>
                                <th>
                                    <strong>{{ $auction->seller->name }}</strong>
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
                                        Rp. {{ number_format($auction->higherBid(), 0, '.', '.')}}
                                    </strong>
                                    <button type="button" class="btn btn-link btn-sm fa fa-history text-primary pull-right p-0" data-toggle="collapse" data-target="#bidHistory" aria-control="bidHistory" title="Riwayat Penawaran"></button>
                                    <ul class="list-group list-group-flush collapse pt-3" id="bidHistory">
                                        {{-- If There's no Bid --}}
                                        @if (count($auction->bids) <= 0)
                                            <li class="list-group-item list-group-item-light"><i class="fa fa-warning fa-fw"></i>Tidak ada Bid saat ini</li> 
                                        {{-- If There's Bid Available --}}
                                        @else
                                            @foreach ($auction->bids as $bid)
                                                <li class="list-group-item list-group-item-light" title="{{ Auth::user()->id == $bid->users_id ? 'Your Bid' : 'By: '.$bid->user->name }}">
                                                    {{ $no++.'. Rp. '.number_format($bid->price, 0,'.','.') }}
                                                    @if (Auth::user()->id == $bid->users_id)
                                                        <i class="fa fa-user fa-fw"></i>
                                                    @endif
                                                    <small class="pull-right">{{ $bid->created_at->diffForHumans() }}</small>
                                                </li>
                                            @endforeach    
                                        @endif
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
                        @if (Auth::user()->id == $auction->users_id)
                            <a href="{{ route('auction.edit', $auction) }}" class="btn btn-info font-weight-bold col text-light"><i class="fa fa-edit"></i> Edit</a>
                        @else
                            <button type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="" class="btn btn-success font-weight-bold col-12"><i class="fa fa-exclamation-circle fa-fw"></i>Bid Now</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bid</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('bid', $auction) }}" method="post" id="bid">
                                            @csrf
                                            <div class="form-group">
                                                <label for="higherBid" class="col-form-label">Penawaran Harus Diatas:</label>
                                                <input type="text" class="form-control" disabled id="higherBid" value="Rp. {{ number_format($auction->higherBid(), 0, '.', '.')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Penawaran Anda (Rp.):</label>
                                                <input type="number" name="price" class="form-control" id="message-text" placeholder="Ex: {{ $auction->higherBid() }}">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" onclick="document.getElementById('bid').submit()" class="btn btn-primary"><i class="fa fa-exclamation-circle fa-fw"></i>Bid Now</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                    </div>
                </div>
        
        <hr class="p-4 mb-1">

        {{-- comment section --}}
        <div class="owner-info row col-lg-12">
            <div class="col-lg-6 order-lg-1 order-3 comment">
                <h5 class="font-weight-bold">Comment ({{ count($comments) }})</h5>
                <form action="{{ route('auction.comment', $auction->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        @guest
                            <a href="{{ route('login') }}" class="fa fa-sign-in btn btn-primary btn-sm my-2"> Login</a>
                        @else
                            <textarea class="form-control" name="content" id="comment" rows="3" placeholder="Your comment here...">{{ old('comment') }}</textarea>
                            <button type="submit" class="fa fa-send btn btn-primary btn-sm my-2"> Send</button>
                        @endguest
                    </div>
                </form>
                @foreach ($comments as $comment)
                    <div class="border-top p-3">
                        <span class="font-weight-bold">{{ $comment->user->name }}</span>
                        <small class="text-secondary ml-2">{{ $comment->created_at->diffForHumans() }}</small>
                        <p>{{ $comment->content }}</p>
                        <small class="p-0 m-0">
                            <a href="#">Reply</a>
                        </small>    
                    </div>    
                @endforeach
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
                        <th>{{ $auction->seller->name }}</th>
                    </tr>
                    <tr>
                        <td>Seller Code</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->seller_code }}</th>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->gender }}</th>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->country }}</th>
                    </tr>
                    <tr>
                        <td>City</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->city }}</th>
                    </tr>
                    <tr>
                        <td>ZIP</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->zip }}</th>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->address }}</th>
                    </tr>
                    <tr>
                        <td>Telp.</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->telp }}</th>
                    </tr>
                    <tr>
                        <td>Registered At</td>
                        <th>:</th>
                        <th>{{ $auction->seller->userinfo->created_at->toFormattedDateString() }}</th>
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

    document.getElementById("countDownTime").innerHTML = '<span class="text-dark">Deadline : </span>' + hari + jam + menit + sec;
}, 1000);

</script>
@endsection
