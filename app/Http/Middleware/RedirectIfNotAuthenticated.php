<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type = null): Response
    {
        // Jika tidak ada tipe diberikan, lanjutkan saja
        if (is_null($type)) {
            return $next($request);
        }

        // Jika tipe adalah 'guest'
        if ($type === 'guest') {
            if (!Auth::check()) {
                return $next($request);
            }
        }

        // Jika user terautentikasi dan tipe sesuai
        if (Auth::check() && Auth::user()->type === $type) {
            return $next($request);
        }

        // Default redirect jika tidak memenuhi kondisi
        return redirect()->route('homepage');
    }
}
