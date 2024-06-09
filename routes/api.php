<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WalletController;


Route::group(['middleware' => 'api'], function () {
    Route::post('/generate-token', [UserController::class, 'generateToken']);
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('/token-refresh', [UserController::class, 'refresh']);
    Route::post('/wallet/credit', [WalletController::class, 'credit']);
    Route::post('/wallet/debit', [WalletController::class, 'debit']);
    Route::get('/wallet/balance/{userId}', [WalletController::class, 'balance']);
});

