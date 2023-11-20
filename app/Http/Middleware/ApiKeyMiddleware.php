<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $envApiKey = config('app.api_key');
        $requestApiKey = $request->get('api_key');

        if ($envApiKey !== $requestApiKey) {
            return response()->json(['reason' => trans('errors.api_key')], 401);
        }

        return $next($request);
    }
}
