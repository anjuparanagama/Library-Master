<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;

// Redirect root to books
Route::redirect('/', '/books');

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
