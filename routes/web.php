<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['auth', 'verified']], function() {
    require __DIR__.'/pages/user.php';
    require __DIR__.'/pages/types.php';
    require __DIR__.'/pages/payments.php';
    require __DIR__.'/pages/visits.php';
    require __DIR__.'/pages/vacations.php';
    require __DIR__.'/pages/calendaries.php';
    require __DIR__.'/pages/events.php';
    require __DIR__.'/pages/store.php';
});

require __DIR__.'/auth.php';
