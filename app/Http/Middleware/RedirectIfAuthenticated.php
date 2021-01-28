<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ProfileController;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guards = null)
    {
        if (Auth::check()) {
            return redirect()->action([ProfileController::class, 'show', Auth::user()->username]);
        }

        return $next($request);
    }
}
