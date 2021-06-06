<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(2)
            ->state(new Sequence([
                'title' => 'Шапка',
                'photo' => 'products/2.jpg',
            ], [
                'title' => 'Кружка',
                'photo' => 'products/1.jpg',
            ]))
            ->create();
    }
}
