<?php

namespace App\Http\Middleware;

use Closure;

class ActiveUser
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
        // IF Company Deleted
        if(auth()->user()->company->deleted) {
            auth()->logout();
            $request->session()->invalidate();
            return redirect(route('login'))->withErrors(__('lang.you_cannot_login'));
        }
        return $next($request);
    }
}
