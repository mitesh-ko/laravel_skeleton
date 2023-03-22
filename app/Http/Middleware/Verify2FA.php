<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Verify2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Not authenticated => no need to check
        if (!Auth::check()) {
            return $next($request);
        }

        // 2FA not enabled => no need to check
        if (is_null(Auth::user()->twofa_key)) {
            return $next($request);
        }

        // 2FA is already checked
        if (session("2fa_checked", false)) {
            return $next($request);
        }

        // at this point user must provide a valid OTP
        // but we must avoid an infinite loop
        if (request()->routeIs('verify.2fa')) {
            return $next($request);
        }

        return redirect(route('verify.2fa'));
    }
}
