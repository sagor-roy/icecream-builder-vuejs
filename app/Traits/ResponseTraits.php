<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTraits
{
    public function responseSuccess($data = [], $message = "Successful"): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'error' => null,
            'data' => $data,
        ]);
    }

    public function responseError($error = "", $message = "Invalid Data"): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => $error,
            'data' => null,
        ]);
    }
}
