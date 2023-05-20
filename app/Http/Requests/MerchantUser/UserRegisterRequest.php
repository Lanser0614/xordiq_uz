<?php

namespace App\Http\Requests\MerchantUser;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['required', 'integer'],
            'email' => ['nullable', 'string', 'email'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ];
    }
}
