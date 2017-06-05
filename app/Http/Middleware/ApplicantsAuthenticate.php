<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class ApplicantsAuthenticate
{



    public function handle($request, Closure $next){

        if ($request->user()->type != 0) {
            return redirect('/');
        }
        return $next($request);
    }
}
