<?php


namespace App\Repositories;


use App\Models\Event;

class EventRepository
{
    public function getEventsByUser($userId = null) {
        return $userId ? Event::where('user_author_id', $userId)->get() : Event::all();
    }

    public function getEventsByDate($date) {

        return Event::whereYear('date_start', $date[0])
            ->whereMonth('date_start', $date[1])
            ->orWhere(function ($q) use ($date) {
                $q->whereMonth('date_end', $date[1]);
            })
            ->get();
    }

    public function create($event) {
        return Event::create($event);
    }

    public function update($event, $new) {
        return $event->update($new);
    }

    public function delete(Event $event) {
        Event::destroy($event->id);
    }

}
