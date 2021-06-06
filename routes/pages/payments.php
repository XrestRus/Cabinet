<?php
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'isCurrentUser'], function() {
    Route::get('/payment', [PaymentController::class, "index"])->name('payment.index');
    Route::get('/payment/group/{user}/{year}/{month}/', [PaymentController::class, "show_group"])->name('payment.group.show');

    Route::get('/payment/group/download/pdf/{user}/{year}/{month}/', [PaymentController::class, "loadPdf"])->name('payment.group.download.pdf');
});

Route::group(['middleware' => 'isAdmin'], function() {
    Route::post('/payment/add', [PaymentController::class, "store"])->name('payment.create');

    Route::post('/payment/{payment}/edit', [PaymentController::class, "update"])->name('payment.edit');
    Route::post('/payment/{payment}/remove', [PaymentController::class, "destroy"])->name('payment.remove');

    Route::post('/payment/group/{user}/{year}/{month}/remove', [PaymentController::class, "remove_group"])->name('payment.group.remove');
});
