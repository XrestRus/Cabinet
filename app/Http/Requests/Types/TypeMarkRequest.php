<?php

namespace App\Http\Requests\Types;

use Illuminate\Foundation\Http\FormRequest;

class TypeMarkRequest extends FormRequest
{
    public function messages() {
        return [
            'title.required' => 'Название обязательно',
            'title.string' => 'Должно быть строкой',
            'title.max' => 'Максимально 255 символов',

            'code.required' => 'Код обязательно',
            'code.string' => 'Должно быть строкой',
            'code.max' => 'Максимально 255 символов',

            'patronymic.required' => 'Отчество обязательно',
            'patronymic.string' => 'Должно быть строкой',
            'patronymic.max' => 'Максимально 255 символов',

            'photo.mimes' => 'Тип файла [.png, .jpg]',

            'email.required' => 'Почта обязательно',
            'email.string' => 'Должно быть строкой',
            'email.max' => 'Максимально 255 символов',
            'email.email' => 'Должна соотвествовать шаблону [*@*.*]',
            'email.unique' => 'Почта должна быть уникальной',

            'password.required' => 'Пароль обязательно',
            'password.string' => 'Должно быть строкой',
            'password.min' => 'Не меньше 8 символов',

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
            'code' => 'required|string|max:255',
        ];
    }
}
