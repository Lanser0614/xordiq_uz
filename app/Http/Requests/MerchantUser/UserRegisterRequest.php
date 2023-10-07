<?php

namespace App\Http\Requests\MerchantUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\Validation\ValidationException;

class UserRegisterRequest extends FormRequest
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
            'phone' => ['required', 'integer', 'max_digits:9', 'unique:merchant_users,phone'],
            'email' => ['nullable', 'string', 'email', 'unique:merchant_users,email'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ];
    }
}
