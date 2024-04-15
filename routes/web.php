<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/book/{id}', [PagesController::class, 'book'])->name('book');
Route::get('/account', [PagesController::class, 'account'])->name('account')->middleware('auth');

// Route for clearing caches
Route::get('/clear-caches', function () {
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'clear';
});

// Route for linking storage
Route::get('/link-storage', function () {
    Artisan::call('storage:link');
});
