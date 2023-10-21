<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-Bearer-Token');
        $configToken = config('auth.token');
        if (!$token || $token !== $configToken) {
            return response()->json(['error' => 'Wrong token'], 419);
        }

        return $next($request);
    }
}
