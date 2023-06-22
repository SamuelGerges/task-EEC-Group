<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiGateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $request->headers->add([
            "is_api_call" => "yes"
        ]);
        return $next($request);
    }
}
