<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            Auth::user()->userinfo()->update([
                'lastActivity' => \Carbon\Carbon::now()->addMinutes(1)
            ]);
        }

        return $next($request);
    }
}
