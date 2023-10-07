<?php

namespace App\Http\Requests\MerchantUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\Validation\ValidationException;

class LoginWithOtpRequest extends FormRequest
{
    /**
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException('Validation error', 422, [implode(',', $validator->errors()->all())]);
    }

    public function rules(): array
    {
        return [
            'phone' => ['integer', 'required'],
            'otp' => ['integer', 'required'],
        ];
    }
}
