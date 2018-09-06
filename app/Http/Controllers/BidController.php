<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;
use Auth;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Store Bid Handler
    public function store($id)
    {
        // Validate request & passing AuctionsID
        Bid::validateBid(request(), $id);
        // Store into database
        Bid::addBid($id);

        alert()->success('Success!', 'Your Bid Has Been Sent!');
        return redirect(url()->previous());
    }
}
