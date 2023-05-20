<?php

namespace App\Http\Requests\MerchantUser;

use Illuminate\Foundation\Http\FormRequest;

class LoginWithOtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['integer', 'required'],
            'otp' => ['integer', 'required'],
        ];
    }
}
