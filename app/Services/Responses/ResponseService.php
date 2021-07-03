<?php


namespace App\Services\Responses;


use Illuminate\Http\JsonResponse;

class ResponseService
{
    private static function responseParams($status, $errors = [], $data = []): array
    {
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data,
        ];
    }

    public static function sendJsonResponse($status, $code = 200, $errors = [], $data = []): JsonResponse
    {
        return response()->json(
            self::responseParams($status, $errors, $data),
            $code
        );
    }

    public static function successResponse($data = []): JsonResponse
    {
        return self::sendJsonResponse(true,200,[],$data);
    }

    public static function notFoundResponse($data = []): JsonResponse
    {
        return self::sendJsonResponse(false,404,[],[]);
    }
}
