<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\Validation\ValidationException;

class RoomStoreRequest extends FormRequest
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
            'price' => ['required', 'integer'],
            'home_photo' => ['required', 'image'],
            'photos' => ['required', 'array'],
            'photos.*' => ['required', 'image'],
            'room_feature_ids' => ['required', 'array'],
            'room_feature_ids.*' => ['required', 'integer'],
        ];
    }
}
