<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function messages() {
        return [
            'clock.required' => 'Часы обязательны',
            'clock.string' => 'Должно быть строкой',
            'clock.min' => 'Не должно быть меньше 0',

            'days.required' => 'Дни обязательны',
            'days.string' => 'Должно быть строкой',
            'days.min' => 'Не должно быть меньше 0',

            'sum.required' => 'Сумма обязательна',
            'sum.string' => 'Должно быть строкой',
            'sum.min' => 'Не должно быть меньше 0',

            'date.required' => 'Дата обязательно',
            'date.date' => 'Должно быть датой',
            'date.before' => 'Дата должна быть до текущего числа',

            'user.array' => 'Тут должен быть пользователь',

            'type_payment.array' => 'Тут должен быть тип расчета',
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
            'clock' => 'required|numeric|min:0',
            'days' => 'required|numeric|:0',
            'sum' => 'required|numeric|min:0',
            'date' => 'required|date|before:today',
            'user' => 'sometimes|array',
            'type_payment' => 'array'
        ];
    }
}
