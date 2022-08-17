<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()){
            return response()->json([
                'message' => 'Please login.',
            ], 403);
        }

        return $next($request);
    }
}
