<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class RedirectAdmin
{

    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->admin)
            return view('admin.admin');

        return $next($request);
    }
}
