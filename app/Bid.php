<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{

    // return list of bids that belongs to auction
    public function bids()
    {
        return $this->belongsTo(Auctions::class, 'auction_id');
    }
    
    // Access bidder of a Auction
    // return user 
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
