<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function messages() {
        return [
            'title.required' => 'Название обязательно',
            'title.string' => 'Должно быть строкой',
            'title.max' => 'Максимально 255 символов',

            'desc.required' => 'Описание обязательно',
            'desc.string' => 'Должно быть строкой',
            'desc.max' => 'Максимально 255 символов',

            'date_start.required' => 'Дата начала обязательно',
            'date_start.date' => 'Должно быть датой',

            'date_end.required' => 'Дата окончания обязательно',
            'date_end.date' => 'Должно быть датой',
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
            'title' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'user_author_id' => 'required',
        ];
    }
}
