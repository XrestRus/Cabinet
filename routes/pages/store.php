<?php
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Store\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/store', [StoreController::class, "index"])->name('store.index');
Route::post('/store/order', [OrderController::class, "store"])->name('store.order.create');

Route::post('/store/order/{id}/success', [OrderController::class, "success"])->name('store.order.success');
Route::post('/store/order/{id}/cancel', [OrderController::class, "cancel"])->name('store.order.cancel');


Route::group(['middleware' => 'isCurrentUser'], function() {
    Route::get('/store/order/{id}', [OrderController::class, "show"])->name('store.order.show');
});

Route::group(['middleware' => 'isAdmin'], function() {
    Route::get('/store/order', [OrderController::class, "index"])->name('store.order.index');

    Route::post('/store/add', [StoreController::class, "store"])->name('store.create');
    Route::post('/store/{id}/edit', [StoreController::class, "update"])->name('store.edit');
    Route::post('/store/{id}/remove', [StoreController::class, "destroy"])->name('store.remove');
});