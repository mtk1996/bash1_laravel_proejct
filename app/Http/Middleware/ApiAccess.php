<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('api')->check()) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'data' => 'login_first',
            ]);
        }
        return $next($request);
    }
}
