<?php

namespace Database\Seeders;

use App\Models\Type__mark;
use App\Models\Type__order;
use App\Models\Type__payment;
use App\Models\Type__transaction;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type__order::factory()
            ->count(3)
            ->state(new Sequence(
                [ 'title' => 'Куплено' ],
                [ 'title' => 'Отменено' ],
                [ 'title' => 'Получено' ],
            ))
            ->create();

        Type__mark::factory()
            ->count(10)
            ->state(
                new Sequence(
                    [ 'code' => 'Б', 'title' => 'больничный с больничным листом' ],
                    [ 'code' => 'В', 'title' => 'выходной' ],
                    [ 'code' => 'К', 'title' => 'командировка' ],
                    [ 'code' => 'НН', 'title' => 'неявка по невыясненным причинам' ],
                    [ 'code' => 'П', 'title' => 'посещено' ],
                    [ 'code' => 'ПК', 'title' => 'повышение квалификации' ],
                    [ 'code' => 'РП', 'title' => 'явка в выходной день (отработка)' ],
                    [ 'code' => 'Т', 'title' => 'неоплачиваемый больничный без больничного листа' ],
                    [ 'code' => 'У', 'title' => 'учебный отпуск с вызовом из образовательного' ],
                    [ 'code' => 'Я', 'title' => '(явка) рабочий день' ],
                )
            )
            ->create();

        Type__transaction::factory()
            ->count(2)
            ->state(new Sequence(
                ['title' => 'Начисления'],
                ['title' => 'Удержания']
            ))
            ->create();

        Type__payment::factory()
            ->count(15)
            ->state(
                new Sequence(
                    [ 'title' => 'Отпускные', 'type_transaction_id' => 1],
                    [ 'title' => 'Премия', 'type_transaction_id' => 1],
                    [ 'title' => 'Пособия', 'type_transaction_id' => 1],
                    [ 'title' => 'Командировка', 'type_transaction_id' => 1],
                    [ 'title' => 'Прочие начисления', 'type_transaction_id' => 1],
                    [ 'title' => 'Зарплата', 'type_transaction_id' => 1],
                    [ 'title' => 'Доплата', 'type_transaction_id' => 1],
                    [ 'title' => 'Выслуга лет', 'type_transaction_id' => 1],
                    [ 'title' => 'Больничные', 'type_transaction_id' => 1],
                    [ 'title' => 'Прочие удержания', 'type_transaction_id' => 2],
                    [ 'title' => 'Удержание профсоюзных ', 'type_transaction_id' => 2],
                    [ 'title' => 'Алименты', 'type_transaction_id' => 2],
                    [ 'title' => 'Квартплата', 'type_transaction_id' => 2],
                    [ 'title' => 'Удержание ссуды', 'type_transaction_id' => 2],
                )
            )
            ->create();

    }
}
