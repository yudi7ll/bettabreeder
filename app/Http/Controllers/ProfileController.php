<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Bid;
use App\User;
use App\Userinfo;
use Storage;

class ProfileController extends Controller
{

    // Auth check
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Return Profile page
    public function index()
    {
        $bidding = Bid::find(Auth::user()->id);
        return view('user.profile', compact(['bidding']));
    }

    // return profile.edit page
    public function edit()
    {
        $user = \App\User::find(Auth::user()->id);
        return view('user.edit', compact('user'));
    }

    // update request handler
    public function update()
    {
        // find user_id Userinfo
        $userinfo = Userinfo::find(Auth::user()->id);
        // validate request userinfo
        $userinfo->userinfoValidate();
        // update data database
        $userinfo->userinfoUpdate();

        // find user id User for name
        $user = User::find(Auth::user()->id);
        // updating name
        $user->updateName();

        alert()->success('Done!', 'Your profile has been updated.');
        return redirect()->route('profile');
    }

    // cover update handler
    public function cover()
    {
        // return dd(request());
        Storage::putFile('images', request()->file('cover'));
    }
}
