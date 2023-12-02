<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminCheckMiddleware
{
   public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->user_type_id !== 1) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
