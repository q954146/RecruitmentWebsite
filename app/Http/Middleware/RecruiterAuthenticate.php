<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class RecruiterAuthenticate
{



    public function handle($request, Closure $next){

        if ($request->user()->type != 1) {
            return redirect('/');
        }

        return $next($request);
    }
}
