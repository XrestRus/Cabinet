<?php

namespace App\Http\Controllers\Calendaries;

use App\Models\User;
use App\Models\Event;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CalendarProductionController extends Controller
{
    public function index()
    {
        return Inertia::render("Calendaries/CalendarProduction");
    }
}
