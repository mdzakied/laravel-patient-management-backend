<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Get user from token jwt
        $user = JWTAuth::parseToken()->authenticate();

        // Check user
        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404); // Not Found
        }

        // Check role
        if ($user->role !== $role) {
            return response()->json([
                'message' => 'You do not have permission to access this resource.',
            ], 403); // Forbidden
        }

        // Next middleware
        return $next($request);
    }
}
