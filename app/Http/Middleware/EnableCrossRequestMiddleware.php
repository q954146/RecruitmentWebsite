<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Response;

class EnableCrossRequestMiddleware
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
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', 'http://123.207.137.43');
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Session, Accept, OPTIONS,X-CSRF-TOKEN');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT');
        $response->header('Access-Control-Allow-Credentials', 'true');
        return $response;
    }
}
