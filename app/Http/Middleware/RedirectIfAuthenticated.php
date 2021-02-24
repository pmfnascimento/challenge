<?php

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;
use Closure;


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
                    return redirect()->route('admin.home');
                }
                break;
            case 'manager':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('managers.home');
                }
                break;
            case 'driver':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('drivers.home');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                }
                break;
        }
        return $next($request);
    }
}
