<?php

namespace App\Http\Requests\MerchantUser;

use App\Exceptions\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException("Validation error", 422, [implode(",",$validator->errors()->all())],);
    }
    public function rules(): array
    {
        return [
            'phone' => ['integer', 'required'],
            'password' => ['string', 'required'],
        ];
    }
}
