<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Type__order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()
            ->count(15)
            ->create();
    }
}
