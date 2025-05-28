<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::middleware('guest:api')
    ->group(function () {
        Route::prefix('auth')
            ->as('auth.')
            ->group(function () {
                Route::post('/register', [AuthController::class, 'register'])->name('register');
            });

        Route::prefix('posts')
            ->as('posts.')
            ->group(function () {
                Route::get('/', [PostController::class, 'index'])->name('list');
                Route::get('/{uuid}', [PostController::class, 'show'])->name('show.post');
            });
});


Route::middleware('auth:api')
    ->group(function () {
        Route::prefix('posts')
            ->as('posts.')
            ->group(function () {
                Route::post('/create', [PostController::class, 'store'])->name('create.post');
            });
});