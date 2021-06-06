<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'birthday.before' => 'Дата должна быть до текущего числа'
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
            'phone' => 'sometimes|nullable|numeric|min:11',
            'birthday' => 'sometimes|nullable|date|before:today',
            'role' => 'sometimes|array',
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
