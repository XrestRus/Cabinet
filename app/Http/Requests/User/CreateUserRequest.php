<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function messages() {
        return [
            'name.required' => 'Имя обязательно',
            'name.string' => 'Должно быть строкой',
            'name.max' => 'Максимально 255 символов',

            'surname.required' => 'Фамилия обязательно',
            'surname.string' => 'Должно быть строкой',
            'surname.max' => 'Максимально 255 символов',

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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->photo))
            $this->validate(['photo' => 'sometimes|nullable|string']);
        else
            $this->validate(['photo' => 'sometimes|nullable|mimes:png,jpg']);
    }
}
