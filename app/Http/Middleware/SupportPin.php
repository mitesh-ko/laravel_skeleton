<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportPin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('backToAccount', false)) {
            if (session('support_pin_verified', false) || request()->routeIs(['supportPinVerify.get', 'supportPinVerify.check', 'loginAs']))
                return $next($request);

            return redirect()->route('supportPinVerify.get');
        }
        return $next($request);
    }
}
