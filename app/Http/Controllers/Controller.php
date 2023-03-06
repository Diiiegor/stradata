<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse($data): JsonResponse
    {
        return response()->json([
            'error' => false,
            'message' => 'success',
            'status' => 200,
            'data' => $data
        ])->setStatusCode(200);
    }

    protected function errorResponse($message, $status = 401): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'status' => $status,
            'data' => null
        ])->setStatusCode($status);
    }
}
