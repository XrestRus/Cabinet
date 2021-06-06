<?php

namespace App\Http\Requests\Types;

use Illuminate\Foundation\Http\FormRequest;

class TypePaymentRequest extends FormRequest
{
    public function messages() {
        return [
            'title.required' => 'Название обязательно',
            'title.string' => 'Должно быть строкой',
            'title.max' => 'Максимально 255 символов',

            'type_transaction.required' => 'Тип транзакции обязательно',
            'type_transaction.mimes' => 'Формат должен быть .pdf',
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
            'type_transaction' => 'required|array',
        ];
    }

}
