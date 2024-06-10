<?php

namespace App\Http\Middleware;

use App\Services\UserLoggingServices;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class UserLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        \App\Models\UserLogging::query()->create([
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'route_name' => Route::currentRouteName(),
            'url' => $request->getRequestUri(),
            'request' => json_encode($request->all()),
            'status' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
