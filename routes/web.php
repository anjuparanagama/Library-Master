<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;

// Authentication routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        // Books routes
        Route::resource('books', BookController::class);

        // Categories routes
        Route::resource('categories', CategoryController::class);

        // Users routes
        Route::resource('users', UserController::class);

        // Borrow routes
        Route::get('/borrow/issue', [BorrowController::class, 'showIssueForm'])->name('borrow.issue');
        Route::post('/borrow/issue', [BorrowController::class, 'storeIssue'])->name('borrow.store-issue');

        Route::get('/borrow/return', [BorrowController::class, 'showReturnForm'])->name('borrow.return');
        Route::post('/borrow/return', [BorrowController::class, 'storeReturn'])->name('borrow.store-return');

        Route::get('/borrow/logs', [BorrowController::class, 'showLogs'])->name('borrow.logs');
    });
});
