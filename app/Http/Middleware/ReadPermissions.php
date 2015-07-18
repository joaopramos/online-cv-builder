<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\User;

class ReadPermissions
{

    public function handle($request, Closure $next, $id)
    {

        if (Auth::check() && Auth::user()->id==$id)
            return $next($request);
        else if(User::find($id)->cv->published)
            return $next($request);

        return response("Not autorized.", 401);
    }

}
