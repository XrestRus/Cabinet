<?php
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['isCurrentUser', 'dateConvert']], function() {
    Route::get('/visit/{user}', [VisitController::class, "show"])->name('visit.show');

    Route::get('/visit/download/{user}/pdf', [VisitController::class, "loadPdf"])->name('visit.download.pdf');

});

Route::group(['middleware' => ['isAdmin', 'dateConvert']], function() {
    Route::get('/visit', [VisitController::class, "index"])->name('visit.index');
    Route::post('/visit/add', [VisitController::class, "store"])->name('visit.create');
    Route::post('/visit/{visit}/edit', [VisitController::class, "update"])->name('visit.edit');
});
