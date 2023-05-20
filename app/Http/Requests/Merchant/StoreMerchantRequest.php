<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title_uz" => ['required', "string"],
            "title_ru" => ['required', "string"],
            "title_en" => ['required', "string"],
            "description_uz" => ['required', "string"],
            "description_ru" => ['required', "string"],
            "description_en" => ['required', "string"],
            "latitude" => ['required', "numeric"],
            "longitude" => ['required', "numeric"],
            "book_commisison" => ['required', "integer"],
            "home_photo" => ["required", "image"],
            "photos" => ["required", "array"],
            "photos.*" => ["required", "image"]
        ];
    }
}
