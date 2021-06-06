<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function messages() {
        return [
            'user_id.required' => 'ИД пользователя обязательно',
            'user_id.numeric' => 'Должен быть номером',

            'product_id.required' => 'ИД продукта обязательно',
            'product_id.numeric' => 'Должен быть номером',
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
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
        ];
    }

    protected function prepareForValidation()
    {

    }
}
