<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
{
    public function messages() {
        return [
            'clock.numeric' => 'Должно быть числом',
            'clock.min' => 'Не должно быть меньше 0',
            'clock.max' => 'Не должно быть больше 24',

            'desc.required' => 'Описание обязательно',
            'desc.string' => 'Должно быть строкой',
            'desc.max' => 'Максимально 255 символов',

            'date.date' => 'Должно быть датой',

            'user_id.required' => 'Тут должен быть пользователь',
            'type_mark.required' => 'Тут должна быть отметка',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "clock" => "numeric|min:0|max:24",
            "type_mark" => "array",
            "date" => "date",
            "user_id" => "numeric"
        ];
    }
}
