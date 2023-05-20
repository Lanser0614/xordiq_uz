<?php

namespace App\Http\Controllers\BaseApiController;

class BaseApiController extends Controller
{
    protected function responseWithToken(string $token, string $message = 'success', int $code = 200): array
    {
        return [
            'token' => $token,
            'message' => $message,
            'code' => $code,
        ];
    }

    protected function responseSuccess(string $message = 'success', int $code = 200): array
    {
        return [
            'message' => $message,
            'code' => $code,
        ];
    }

    protected function responseOnDelete(string $message = 'deleted', int $code = 204): array
    {
        return [
            'message' => $message,
            'code' => $code,
        ];
    }

    protected function responseOnError(string $message = 'deleted', int $code = 204): array
    {
        return [
            'message' => $message,
            'code' => $code,
        ];
    }
}
