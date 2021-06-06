<?php


namespace App\Repositories;


use App\Models\Vacation;

class VacationRepository
{
    public function getVacationsByUser($userId) {
        return $userId
            ? Vacation::with('user')->where('user_id', $userId)->get()
            : Vacation::with('user')->get();
    }

    public function create($vacation) {
        Vacation::create([
            'user_id' => $vacation->user['id'],
            'date_start' => $vacation->date_start,
            'date_end' => $vacation->date_end,
        ]);
    }

    public function update($vacation, $new) {
        return $vacation->update([
            'user_id' => $new->user['id'],
            'date_start' => $new->date_start,
            'date_end' => $new->date_end,
        ]);
    }

    public function delete(Vacation $vacation) {
        return Vacation::destroy($vacation->id);
    }

}
