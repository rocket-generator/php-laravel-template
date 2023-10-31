<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next): mixed
    {
        $response = $next($request);
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-UA-Compatible', 'chrome=1');
        if ($response->headers->get('content-type') === 'application/json') {
            $response->headers->set('Content-Security-Policy', 'default-src \'none\'');
        }

        return $response;
    }
}
