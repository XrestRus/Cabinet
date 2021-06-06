<?php


namespace App\Repositories\User;


use App\Models\User;

class PayToUser
{
    public function __invoke()
    {
        User::all()->each(function ($user, $index) {
            $user->update([
                'money' => $user->money + 10,
            ]);
        });
    }
}
