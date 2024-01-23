<?php

namespace App\Exceptions\Validation;

use Illuminate\Http\JsonResponse;

class ValidationException extends \Exception {
    public function __construct(
        string $message,
        int $code,
        private readonly array $messages
    ) {
        parent::__construct($message, $code);
    }

    public function render(): JsonResponse {
        return new JsonResponse([
            'error' => [
                'status' => $this->getCode(),
                'errors' => $this->messages,
                'message' => $this->getMessage(),
            ],
        ], $this->getCode());
    }
}
