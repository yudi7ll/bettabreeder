@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<div class="container home mt-4">
    <div class="row">
        <div class="profile-picture col-lg-3">
            <h5 class="font-weight-bold">Picture</h5>
            <div id="cropping">
                <img class="rounded img-fluid" src="{{ asset('images/'.$auction->image) }}" alt="No Images">
            </div>
            <div class="profile-picture mt-1">
                <input type="file" name="cover" id="cover" class="d-none">
                <button type="button" id="upload-btn" data-link="{{ route('auction.image.store', $auction) }}" onclick="document.getElementById('cover').click();" class="btn btn-dark font-weight-bold btn-sm py-2 mb-4 mt-1 col-12"><i class="fa fa-upload"></i> Upload New Photo</button>
                <button type="button" id="submit-btn" class="d-none btn btn-primary font-weight-bold col-12"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
        <div class="col-lg-9">
            <h5 class="font-weight-bold text-danger">
                <i class="fa fa-warning fa-fw"></i>Before you continue, Please Upload an Image
            </h5>
            <hr>
            <h5>Your Auction Info</h5>
            <div class="col-sm-8 mt-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Name : <strong>{{ $auction->name }}</strong>
                    </li>
                    <li class="list-group-item">
                        Owner : <strong>{{ $auction->seller->name }}</strong>
                    </li>
                    <li class="list-group-item">
                        Harga Pembuka : <strong>Rp. {{ number_format($auction->opening_price, 0, '.','.') }}</strong>
                    </li>
                    <li class="list-group-item list-group-item-info">
                        Berakhir s/d : <strong>{{ $auction->deadline->toFormattedDateString() }}</strong>
                    </li>
                </ul>
                <hr>
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

    // cropping
    $('#cover').on('change', function () { 
        // Display save btn
        $('#submit-btn').removeClass('d-none');
        // reset the img src attr
        $('#cropping').html('<img class="rounded img-fluid">');
        // cropping setup
        $uploadCrop = $('#cropping img').croppie({
            boundary:{
                height: 210
            },
            viewport: {
                width: 210,
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
    $('#submit-btn').on('click', function (ev) {
        var dataLink = $('#upload-btn').data('link');
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (img) {
            $.ajax({
                url: dataLink,
                type: "POST",
                data: {image:img},
                success: function (data) {
                    document.location.href="{{ route('profile') }}";
                },
                error: function(){
                    // document.location.href="{{ route('profile.fail') }}";
                }
            });
        });
    });
});
</script>
@endsection
