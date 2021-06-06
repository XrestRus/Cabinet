<?php


namespace App\Repositories;


use App\Models\User;
use App\Models\Visit;

class VisitRepository
{
    public function getAllByUsers($date) {
        return User::with([
            "visits" => function($q) use ($date) {
                $q->whereYear('date', $date[0])
                    ->whereMonth('date', $date[1]);
            }
        ])->get();
    }

    public function getByUser(User $user, $date) {
        return User::with([
            "visits" => function($q) use ($date) {
                $q->whereYear('date', $date[0])
                    ->whereMonth('date', $date[1]);
            }
        ])->find($user->id);
    }

    public function create($visit) {
        return Visit::create([
            'clock' => $visit->clock,
            'type_mark_id' => $visit->type_mark['id'],
            'date' => $visit->date,
            'user_id' => $visit->user_id
        ]);
    }

    public function update($visit, $new) {
        return $visit->update([
            'clock' => $new->clock,
            'type_mark_id' => $new->type_mark['id'],
        ]);
    }

    public function delete(Visit $visit) {
        Visit::destroy($visit->id);
    }

}
