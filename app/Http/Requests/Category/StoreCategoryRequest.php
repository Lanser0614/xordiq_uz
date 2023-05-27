<?php

namespace App\Http\Requests\Category;

use App\Exceptions\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            "title_uz" => ["string", "required"],
            "title_ru" => ["string", "required"],
            "title_en" => ["string", "required"],
            "parent_id" => ["integer", "nullable"],
        ];
}
}
