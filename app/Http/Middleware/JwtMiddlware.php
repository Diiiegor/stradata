<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddlware
{

    public function handle(Request $request, Closure $next): JsonResponse
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'Token is Invalid'], 401);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'Token is Expired'], 401);
        } catch (Exception $e) {
            return response()->json(['status' => 'Authorization Token not found'], 401);
        }
        return $next($request);
    }
}
