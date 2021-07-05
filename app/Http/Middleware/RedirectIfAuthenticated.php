<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::DASHBOARD);
                }
                break;
            case 'web':
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::COMPANY);
                }
                break;
            case 'member':
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::Member);
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }
        return $next($request);
    }
}
