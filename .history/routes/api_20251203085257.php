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
    Route::put('items/{id}', [ItemApiController::class, 'update']);
    Route::delete('items/{id}', [ItemApiController::class, 'destroy']);

    // Items by user
    Route::get('users/{id}/items', [ItemApiController::class, 'itemsByUser']);

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