<?php
use App\Http\Controllers\Types\TypeMarkController;
use App\Http\Controllers\Types\TypePaymentController;
use App\Http\Controllers\Types\TypeTransactionController;
use App\Http\Controllers\Types\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'isCurrentUser'], function() {
    Route::get('/role/{id}/pdf', [RoleController::class, "show_pdf"])->name('role.show.pdf');
});

Route::group(['middleware' => 'isAdmin'], function() {
    Route::get('/payment/type', [TypePaymentController::class, "index"])->name('payment.type.index');
    Route::post('/payment/type/add', [TypePaymentController::class, "store"])->name('payment.type.create');
    Route::post('/payment/type/{id}/edit', [TypePaymentController::class, "update"])->name('payment.type.edit');
    Route::post('/payment/type/{id}/delete', [TypePaymentController::class, "destroy"])->name('payment.type.delete');

    Route::get('/mark', [TypeMarkController::class, "index"])->name('mark.type.index');
    Route::post('/mark/add', [TypeMarkController::class, "store"])->name('mark.create');
    Route::post('/mark/{id}/edit', [TypeMarkController::class, "update"])->name('mark.edit');
    Route::post('/mark/{id}/delete', [TypeMarkController::class, "destroy"])->name('mark.delete');

    Route::get('/role', [RoleController::class, "index"])->name('role.index');
    Route::post('/role/add', [RoleController::class, "store"])->name('role.create');
    Route::post('/role/{id}/edit', [RoleController::class, "update"])->name('role.edit');
    Route::post('/role/{id}/delete', [RoleController::class, "destroy"])->name('role.delete');

    Route::get('/transaction', [TypeTransactionController::class, "index"])->name('transaction.type.index');
    Route::post('/transaction/add', [TypeTransactionController::class, "store"])->name('transaction.create');
    Route::post('/transaction/{id}/edit', [TypeTransactionController::class, "update"])->name('transaction.edit');
    Route::post('/transaction/{id}/delete', [TypeTransactionController::class, "destroy"])->name('transaction.delete');
});
