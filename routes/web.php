<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});
