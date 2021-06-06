<?php

namespace App\Http\Requests\Types;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RoleRequest extends FormRequest
{
    public function messages() {
        return [
            'title.required' => 'Название обязательно',
            'title.string' => 'Должно быть строкой',
            'title.max' => 'Максимально 255 символов',

            'pdf_path.mimes' => 'Формат должен быть .pdf',
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
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->pdf_path))
            $this->validate(['pdf_path' => 'string']);
        else
            $this->validate(['pdf_path' => 'mimes:pdf']);
    }
}
