<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->errorResponse('Unauthorized',401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(): JsonResponse
    {
        auth('api')->logout();
        return $this->successResponse(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return $this->successResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('api')->refresh());
    }
}
