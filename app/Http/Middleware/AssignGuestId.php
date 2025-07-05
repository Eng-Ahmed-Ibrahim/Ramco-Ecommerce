<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssignGuestId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
public function handle(Request $request, Closure $next)
{
    if (auth()->guard('customer')->check()) {
        return $next($request);
    }

    if (!$request->cookie('guest_id')) {
        $guestId = (string) Str::uuid();
        $response = $next($request);
        // @phpstan-ignore-next-line
        return $response->cookie('guest_id', $guestId, 60 * 24 * 30);
    }

    return $next($request);
}

}
