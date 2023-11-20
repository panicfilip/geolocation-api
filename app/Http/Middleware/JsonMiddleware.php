<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\ResponseFactory;

class JsonMiddleware
{
    protected $factory;

    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
