<?php

namespace Database\Factories;

use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date_start = Carbon::parse(
            $this->faker->dateTimeBetween('-1 year', '+1 year')
        );
        $date_end = Carbon::parse($date_start)
            ->addDays(
                $this->faker->numberBetween(5, 25)
            );

        return [
            'date_start' => $date_start,
            'date_end' => $date_end,
            'user_id' => '',
        ];
    }
}
