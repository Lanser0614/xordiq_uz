<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
{
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
        ];
    }
}
