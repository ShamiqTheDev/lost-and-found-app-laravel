<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class authenticateUser
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
        if ( !Auth::check() ) {
            return redirect()->route("index");
        }
        return $next($request);
    }
}
