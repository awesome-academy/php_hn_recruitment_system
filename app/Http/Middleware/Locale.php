<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('language')) {
            $locale = $request->session()->get('language');
            App::setLocale($locale);

            return $next($request);
        }

        if (Auth::check()) {
            $locale = Auth::user()->preferredLocale();
            session(['language' => $locale]);
            App::setLocale($locale);

            return $next($request);
        }

        return $next($request);
    }
}
