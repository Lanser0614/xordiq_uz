<?php

declare(strict_types=1);

namespace App\Http\Requests\Mobile\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class MerchantDistanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'latitudeFrom' => ['required', 'numeric'],
            'longitudeFrom' => ['required', 'numeric'],
            'radius' => ['nullable', 'numeric'],
        ];
    }
}
