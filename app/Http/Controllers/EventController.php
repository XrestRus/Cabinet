<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\User;
use App\Models\Event;
use App\Repositories\EventRepository;
use App\Repositories\User\UserRepository;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $events;
    protected $users;

    public function __construct(EventRepository $events, UserRepository $users)
    {
        $this->events = $events;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $users = $this->users->getAllForAdmin();
        $events = $this->events->getEventsByUser($request->id);

        return Inertia::render("Event/Index", compact("users", "events"));
    }

    public function store(EventRequest $request)
    {
        $this->events->create($request->validated());

        return redirect()->route('event.index');
    }

    public function update(EventRequest $request, Event $event)
    {
        $this->events->update($event, $request->validated());

        return redirect()->route('event.index');
    }

    public function destroy(Event $event)
    {
        $this->events->delete($event);

        return redirect()->route('event.index');
    }
}
