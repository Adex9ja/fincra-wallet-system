<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [UserController::class, 'index'])->name('login');
Route::post('/', [UserController::class, 'login']);

// Routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/users', [UserController::class, 'users']);
    Route::get('/users/{id}', [UserController::class, 'user']);
    Route::get('/transactions', [TransactionController::class, 'transactions']);
    Route::post('/wallet/credit', [WalletController::class, 'credit']);
    Route::post('/wallet/debit', [WalletController::class, 'debit']);
    Route::get('/insight/download', [TransactionController::class, 'download']);
});
