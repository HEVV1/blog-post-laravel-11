<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::middleware([])
    ->group(function () {
        Route::prefix('posts')
            ->as('posts.')
            ->group(function () {
                Route::get('/', [PostController::class, 'index'])->name('list');
                Route::get('/{uuid}', [PostController::class, 'show'])->name('show.post');
                Route::post('/create', [PostController::class, 'store'])->name('create.post');
            });
});