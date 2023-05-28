<?php

namespace App\Http\Requests\MerchantFeature;

use Illuminate\Foundation\Http\FormRequest;

class StoreMerchantFeatureRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title_uz" => ["required", "string"],
            "title_ru" => ["required", "string"],
            "title_en" => ["required", "string"],
            "icon" => ["required", "image"]
        ];
    }
}
