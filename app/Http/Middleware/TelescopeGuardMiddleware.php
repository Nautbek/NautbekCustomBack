<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function Laravel\Prompts\error;

class TelescopeGuardMiddleware
{
    private const array ACCESS_IPS = [
        '188.212.124.75'
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->isProduction() && !in_array($request->getClientIp(), self::ACCESS_IPS)) {
            return new Response('Only for admin access.', Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
