<?php

namespace App\Http\Middleware;

use Closure;

class CacheableMiddleware
{

    /**
     * A trivial middleware that just returns the Cache-Control header
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response = $next($request);

        $response->header('Cache-Control', 'max-age=600, public');

        return $response;
    }

}