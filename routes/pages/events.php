<?php
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::middleware(['dateConvert'])->get('/event', [EventController::class, "index"])->name('event.index');

Route::group(['middleware' => 'isAdmin'], function() {
    Route::post('/event/add', [EventController::class, "store"])->name('event.create');
    Route::post('/event/{event}/edit', [EventController::class, "update"])->name('event.edit');
    Route::post('/event/{event}/remove', [EventController::class, "destroy"])->name('event.remove');
});
