<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Role;
use App\Models\Type__order;
use App\Models\User;
use App\Models\Vacation;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(2)
            ->state(new Sequence([
                'role' => Role::all()->where('title', 'Администратор')->first()->id,
                'email' => 'admin@ro.ru',
                'password' => Hash::make('admin')
            ], [
                'role' => Role::all()->where('title', 'Сотрудник')->first()->id,
                'email' => 'test@ro.ru',
                'password' => Hash::make('test')
            ]))
            ->has(Vacation::factory()->count(2))
            ->has(Payment::factory()->count(30))
            ->has(Visit::factory()->count(20))
            ->create();

        User::factory()
            ->count(4)
            ->has(Vacation::factory()->count(2))
            ->has(Payment::factory()->count(30))
            ->has(Visit::factory()->count(20))
            ->create();
    }
}
