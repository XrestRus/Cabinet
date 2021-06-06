<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['middleware' => 'isAdmin'], function() {
    Route::get('/user/add', [UserController::class, "create"])->name('user.create');
    Route::post('/user/add', [UserController::class, "store"])->name('user.create');
    Route::post('/user/{user}/delete', [UserController::class, "destroy"])->name('user.delete');
});

Route::group(['middleware' => 'isCurrentUser'], function() {
    Route::get('/user/{user}', [UserController::class, "show"])->name('user.show');
    Route::get('/user/{user}/edit', [UserController::class, "edit"])->name('user.edit');
    Route::post('/user/{user}/edit', [UserController::class, "update"])->name('user.edit');
});


Route::post('/user/pay/{user}', [UserController::class, "pay"])->name('user.pay');

Route::get('/user', [UserController::class, "index"])->name('user.index');
