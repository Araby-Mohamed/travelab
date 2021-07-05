<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is('dashboard*'))
                return route('dashboard.login');
           if (Request::is('member*') || $request->routeIs('cp.memberships.purchase'))
                return route('member.login');
            else
                return route('login');
        }
    }
}
