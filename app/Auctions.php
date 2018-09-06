<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    
}
