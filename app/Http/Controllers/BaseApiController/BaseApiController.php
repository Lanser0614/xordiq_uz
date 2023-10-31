<?php

namespace App\Http\Controllers\BaseApiController;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseApiController extends Controller {
    protected function responseWithToken(string $token, string $message = 'success', int $code = 200): array {
        return [
            'token' => $token,
            'message' => $message,
            'code' => $code,
        ];
    }

    protected function responseSuccess(string $message = 'success', int $code = 200): array {
        return [
            'message' => $message,
            'code' => $code,
        ];
    }

    protected function responseWithResult(array $result) {
        return [
            'result' => $result,
            'status' => $this->responseSuccess(),
        ];
    }

    protected function responseOnDelete(string $message = 'deleted', int $code = 204): array {
        return [
            'message' => $message,
            'code' => $code,
        ];
    }

    protected function responseWithPagination(LengthAwarePaginator $paginator): array {
        return [
            'result' => $paginator->items(),
            'paginator' => [
                'perPage' => $paginator->perPage(),
                'total' => $paginator->total(),
                'currentPage' => $paginator->currentPage(),
                'lastaPage' => $paginator->lastPage(),
            ],
        ];
    }

    public function responseOneItem(Model $model): array {
        return [
            'result' => $model,
            'status' => $this->responseSuccess(),
        ];
    }

    protected function responseOnError(string $message = 'deleted', int $code = 204): array {
        return [
            'message' => $message,
            'code' => $code,
        ];
    }
}
