<?php

namespace App\Http\Requests\MerchantUser;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "phone" => ["integer", "required"],
            "password" => ["string", "required"]
        ];
}
}
