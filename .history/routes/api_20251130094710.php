<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemApiController;
use App\Http\Controllers\Api\BookmarkApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\LogApiController;

Route::prefix('v1')->group(function () {
    // Item endpoints
    Route::get('items', [ItemApiController::class, 'index']);
    Route::get('items/unclaimed', [ItemApiController::class, 'unclaimed']);
    Route::get('items/{id}', [ItemApiController::class, 'show']);
    Route::post('items', [ItemApiController::class, 'store']);
    Route::post('items/{id}/claim', [ItemApiController::class, 'claim']);

    // Bookmark endpoints
    Route::get('users/{userId}/bookmarks', [BookmarkApiController::class, 'index']);
    Route::post('bookmarks', [BookmarkApiController::class, 'store']);
    Route::delete('bookmarks/{id}', [BookmarkApiController::class, 'destroy']);

    // User endpoints
    Route::post('users/register', [UserApiController::class, 'register']);
    Route::post('users/login', [UserApiController::class, 'login']);
    Route::get('users', [UserApiController::class, 'index']);
    Route::get('users/{id}', [UserApiController::class, 'show']);

    // Logs
    Route::get('logs', [LogApiController::class, 'index']);
});

// Also provide non-versioned routes for backwards compatibility
Route::post('users/register', [\App\Http\Controllers\Api\UserApiController::class, 'register']);
Route::post('users/login', [\App\Http\Controllers\Api\UserApiController::class, 'login']);
Route::get('users', [\App\Http\Controllers\Api\UserApiController::class, 'index']);
Route::get('users/{id}', [\App\Http\Controllers\Api\UserApiController::class, 'show']);

Route::get('items', [\App\Http\Controllers\Api\ItemApiController::class, 'index']);
Route::get('items/unclaimed', [\App\Http\Controllers\Api\ItemApiController::class, 'unclaimed']);
Route::get('items/{id}', [\App\Http\Controllers\Api\ItemApiController::class, 'show']);
Route::post('items', [\App\Http\Controllers\Api\ItemApiController::class, 'store']);
Route::post('items/{id}/claim', [\App\Http\Controllers\Api\ItemApiController::class, 'claim']);

Route::get('users/{userId}/bookmarks', [\App\Http\Controllers\Api\BookmarkApiController::class, 'index']);
Route::post('bookmarks', [\App\Http\Controllers\Api\BookmarkApiController::class, 'store']);
Route::delete('bookmarks/{id}', [\App\Http\Controllers\Api\BookmarkApiController::class, 'destroy']);

Route::get('logs', [\App\Http\Controllers\Api\LogApiController::class, 'index']);
