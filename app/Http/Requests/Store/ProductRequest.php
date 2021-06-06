<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function messages() {
        return [
            'title.required' => 'Название обязательно',
            'title.string' => 'Должно быть строкой',
            'title.max' => 'Максимально 255 символов',

            'description.required' => 'Описание обязательно',
            'surname.string' => 'Должно быть строкой',
            'surname.max' => 'Максимально 255 символов',

            'price.required' => 'Цена обязательно',
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
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
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
