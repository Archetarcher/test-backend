<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    /**
     * @param array $result
     * @param int $status
     * @return JsonResponse
     */
    public function sendResponse(array $result, int $status = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
        ];
        return response()->json($response, $status);
    }

    /**
     * @param int $errorCode
     * @param string $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $errorCode, string $errorMessages, int $code = 404): JsonResponse
    {
        $error = [
            'code' => $errorCode,
            'message' => $errorMessages,
        ];

        $response = [
            'success' => false,
            'error' => $error,
        ];

        return response()->json($response, $code);
    }
}
