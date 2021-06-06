<?php
use App\Http\Controllers\Calendaries\CalendarCorporationController;
use App\Http\Controllers\Calendaries\CalendarProductionController;
use Illuminate\Support\Facades\Route;

Route::get('/calendar/production/', [CalendarProductionController::class, "index"])->name('calendar.production.index');
Route::get('/calendar/corporation/', [CalendarCorporationController::class, "index"])->name('calendar.corporation.index');
