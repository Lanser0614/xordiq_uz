<?php

namespace App\Http\Requests\Admin\MerchantUser;

use App\Exceptions\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest {
    /**
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void {
        throw new ValidationException('Validation error', 422, [implode(',', $validator->errors()->all())]);
    }

    public function rules(): array {
        return [
            'phone' => ['required', 'integer', 'max_digits:9', 'unique:merchant_users,phone'],
            'email' => ['nullable', 'string', 'email', 'unique:merchant_users,email'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'old_confirmation' => ['min:8', 'required'],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ];
    }
}
