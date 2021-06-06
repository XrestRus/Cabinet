<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacationRequest extends FormRequest
{
    public function messages() {
        return [
            'user.id.required' => 'ИД пользователя обязательно',
            'user.id.string' => 'Должно быть числом',
            'user.id.min' => 'Не должно быть меньше 1',

            'desc.required' => 'Описание обязательно',
            'desc.string' => 'Должно быть строкой',
            'desc.max' => 'Максимально 255 символов',

            'date_start.required' => 'Дата начала обязательно',
            'date_start.date_format' => 'Формат должен быть [Y-m-d]',
            'date_start.before_or_equal' => 'Дата должна быть меньше даты окончания',

            'date_end.required' => 'Дата окончания обязательно',
            'date_end.date_format' => 'Формат должен быть [Y-m-d]',
            'date_end.after_or_equal' => 'Дата должна быть больше даты начала',
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
            'user.id' => 'required|numeric|min:1',
            'user'=> 'array',
            'date_start' => 'required|date_format:Y-m-d|before_or_equal:date_end',
            'date_end' => 'required|date_format:Y-m-d|after_or_equal:date_start',
        ];
    }
}
