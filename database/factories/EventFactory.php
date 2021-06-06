<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date_start = Carbon::parse(
            $this->faker->dateTimeBetween('-1 week', '+1 week')
        );
        $date_end = Carbon::parse($date_start)
            ->addDays(
                $this->faker->randomNumber(1)
            );

        return [
            'user_author_id' => '1',
            'title' => $this->faker->word(),
            'desc' => $this->faker->text(15),
            'date_start' => $date_start,
            'date_end' => $date_end,
        ];
    }
}
