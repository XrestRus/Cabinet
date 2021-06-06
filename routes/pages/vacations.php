<?php
use App\Http\Controllers\VacationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'isCurrentUser'], function() {
    Route::get('/vacation', [VacationController::class, "index"])->name('vacation.index');
});

Route::group(['middleware' => 'isAdmin'], function() {
    Route::post('/vacation/add', [VacationController::class, "store"])->name('vacation.create');
    Route::post('/vacation/{vacation}/edit', [VacationController::class, "update"])->name('vacation.edit');
    Route::post('/vacation/{vacation}/delete', [VacationController::class, "destroy"])->name('vacation.delete');
});
