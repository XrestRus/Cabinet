<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()
            ->count(5)
            ->state(
                new Sequence(
                    ['title' => 'Администратор'],
                    ['title' => 'Сотрудник'],
                    ['title' => 'Бухгалтер'],
                    ['title' => 'Оператор'],
                    ['title' => 'Дворник'],
                )
            )
            ->create();
    }
}
