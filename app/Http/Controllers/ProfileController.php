<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Userinfo;

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
        return view('user.profile');
    }

    // return profile.edit page
    public function edit()
    {
        return view('user.edit');
    }

    // update request handler
    public function update()
    {
        // find Userinfo
        $userinfo = Auth::user()->userinfo;
        // validate request userinfo
        $userinfo->userinfoValidate();
        // update data database
        $userinfo->userinfoUpdate();

        // find User for name
        $user = Auth::user();
        // updating name
        $user->updateName();

        alert()->success('Saved!', 'Your Profile Has Been Updated!')->autoclose(3500);
        return redirect()->route('profile');
    }

    // cover update handler
    public function cover(Request $request)
    {   
        Userinfo::coverUpdate();
        alert()->success('Saved!', 'New Profile Picture Saved!');
        return response()->json(['status'=>true]);
    }

    // when cover upload return error
    public function error()
    {
        alert()->error('Something Went Wrong!', 'Couldn\'t Proccess Your Request')->autoclose(4000);
        return redirect()->route('profile');
    }
}
