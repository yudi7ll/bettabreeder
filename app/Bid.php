<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Auctions;

class Bid extends Model
{
    // Mass Assigment
    protected $fillable = [
        'price', 'auctions_id'
    ];

    // return list of auction that belongs to auction
    public function auction()
    {
        return $this->belongsTo(Auctions::class, 'auctions_id');
    }
    
    // Access bidder of a Auction
    // return user 
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function scopeValidateBid($query, $request, $id)
    {
        // Check if [$request->price] is higher than [$this->price]
        $auction = Auctions::find($id);
        $price = $auction->higherBid()+1;

        // if [$price] less than [Opening Price]
        if($price < $auction->opening_price){
            // Replace with [opening price]
            $price = $auction->opening_price;
        }
        // Then validate the request
        return $request->validate([
            'price' => 'required|integer|min:'.$price
        ]);
    }
    
    public function scopeAddBid($query, $id)
    {
        return Auth::user()->userbids()->create([
            'auctions_id' => $id,
            'price' => request()->price
        ]);
    }
}
