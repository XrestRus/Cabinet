<?php

namespace App\Http\Controllers\Calendaries;

use App\Models\Event;
use App\Repositories\EventRepository;
use App\Repositories\User\UserRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarCorporationController extends Controller
{
    protected $events;

    public function __construct(EventRepository $events)
    {
        $this->events = $events;
    }

    public function index(Request $request)
    {
        $events = $this->events->getEventsByDate($request->date);

        return Inertia::render("Calendaries/CalendarCorporation", compact("events"));
    }
}
