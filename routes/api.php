<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Тест контроллеры -- Начало
Route::get('/users', function () {
    return App\Models\User::factory(10)->make();
});
Route::get('/users/{id}', function () {
    return App\Models\User::factory(1)->make();
});
//Тест контроллеры -- Конец

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
