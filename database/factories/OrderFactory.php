<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\Type__order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'product_id' => Product::all()->random()->id,
            'state' => Type__order::all()->random()->id,
            'date' => date('Y-m-d')
        ];
    }
}
