<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use File;

class Auctions extends Model
{
    // The Attr will be mutated to dates
    protected $dates = ['deadline', 'start_date'];

    protected $fillable = [
        'image', 'name', 'type', 'size', 'seller_id', 'age',
        'opening_price', 'product_code', 'start_date', 'deadline', 'seen',
        'status'
    ];

    
    // Access user data that belongsTo Auction
    public function seller()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Access bids data that belongsTo auction
    public function bids()
    {
        return $this->hasMany(Bid::class)->latest();
    }

    // return the latest/higher one bids
    public function higherBid()
    {
        if( $higherBid = $this->hasMany(Bid::class)->latest()->first() ){
            return $higherBid->price;
        }else{
            return $this->opening_price;
        }
    }

    // Comment on this auction
    public function comments()
    {
        return $this->hasMany(Comments::class, 'auctions_id')->latest();
    }
    
    
    /**
     * Validate Auctions
     */
    public function scopeValidateAuctions()
    {
        return request()->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'size' => 'required|string',
            'age' => 'required|string',
            'opening_price' => 'required|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date',
        ]);
    }

    /**
     * Add New Auctions
     */
    public function scopeAddAuctions($query, $request)
    {
        return Auth::user()->auctions()->create([
            'name' => $request->name,
            'type' => $request->type,
            'size' => intval($request->size),
            'age' => intval($request->age),
            'opening_price' => intval($request->opening_price),
            'product_code' => 'BT'.Auth::user()->id.time(), //Auto generate the Product Code
            'start_date' => \Carbon\Carbon::parse($request->start_date),
            'seen' => 0,
            'deadline' => \Carbon\Carbon::parse($request->deadline)
        ]);
    }

    /**
     * Update the Image
     */
    public function scopeImageUpload($query, $request, $id)
    {
        // Image request
        $image = $request->image;
        // Select auction
        $auction = $this->find($id);

        list($type, $image) = explode(';', $image);
        // Get base64 of image
        $image = explode(',', $image)[1];
        // Decode the image 
        $image = base64_decode($image);

        // Set image name
        $imageName = $auction->name.time().'.png';
        // Image path
        $path = public_path('images/');

        if($auction->image != 'no-image.png'){
            File::delete($path.$auction->image);
        }

        // Store into database
        $auction->update([
            'image' => $imageName
        ]);

        // Copy the file
        return file_put_contents($path.$imageName, $image);
    }

}
