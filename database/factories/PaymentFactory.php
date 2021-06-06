<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Type__payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->text(14),
            'clock' => $this->faker->numberBetween(0, 120),
            'days' => $this->faker->numberBetween(1, 29),
            'sum' => $this->faker->randomNumber(5),
            'date' => $this->faker->dateTimeBetween('-5 month'),
            'type_payment' => Type__payment::all()->random(),
            'user_id' => User::all()->random(),
        ];
    }
}
