<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function sendResponse(bool $success, string $message, mixed $data, int $status): JsonResponse
    {
        return new JsonResponse([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
