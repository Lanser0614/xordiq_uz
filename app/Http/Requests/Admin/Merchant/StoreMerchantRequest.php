<?php

namespace App\Http\Requests\Admin\Merchant;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\Validation\ValidationException;

class StoreMerchantRequest extends FormRequest
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
            'title_uz' => ['required', 'string'],
            'title_ru' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'description_uz' => ['required', 'string'],
            'description_ru' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'village_id' => ['nullable', 'integer'],
            'district_id' => ['integer', Rule::requiredIf(!$this->has('village_id'))],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'book_commisison' => ['required', 'integer'],
            'home_photo' => ['required', 'image'],
            'photos' => ['required', 'array'],
            'photos.*' => ['required', 'image'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'integer'],
            'merchant_features_ids' => ['nullable', 'array'],
            'merchant_features_ids.*' => ['nullable', 'integer'],
        ];
    }
}
