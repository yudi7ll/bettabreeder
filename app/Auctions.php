<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auctions extends Model
{
    // The Attr will be mutated to dates
    protected $dates = ['deadline', 'start_date'];

    protected $fillable = [
        'name', 'type', 'size', 'seller_id', 'age',
        'opening_price', 'product_code', 'start_date', 'deadline', 'seen',
        'status'
    ];

    
    // Access user data that belongsTo Auction
    public function seller()
    {
        return $this->belongsTo(User::class, 'users_id')->first();
    }

    // Access bids data that belongsTo auction
    public function bids()
    {
        return $this->hasMany(Bid::class)->latest();
    }

    // return the latest/higher one bids
    public function higherBid()
    {
        return $this->hasMany(Bid::class)->latest()->first();
    }

}
