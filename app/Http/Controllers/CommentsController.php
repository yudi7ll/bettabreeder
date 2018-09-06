<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Add Comment Handler
     * @return previous
     */
    public function addComment($auctions_id)
    {
        Auth::user()->comments()->create([
           'auctions_id' => $auctions_id,
           'content' => request()->content
        ]);

        alert()->success('Published!', 'Your Comment Has Been Sent.');
        return redirect(url()->previous());
    }
}
