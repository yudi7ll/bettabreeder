<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    // How Many User Online?
    public function userOnline()
    {
        return count(\App\Userinfo::userStatus());
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
