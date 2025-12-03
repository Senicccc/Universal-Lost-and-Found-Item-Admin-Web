<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LogController;

// Dashboard (halaman utama)
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

// Items CRUD
Route::resource('items', ItemController::class);
Route::put('/items/{id}/claim', [ItemController::class, 'claim'])->name('items.claim');

// Users CRUD
Route::resource('users', UserController::class);

// Bookmarks list
Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

// Logs list
Route::get('/logs', [LogController::class, 'index'])->name('logs.index');