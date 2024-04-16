<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/book/{id}', [PagesController::class, 'book'])->name('book');
Route::get('/account', [PagesController::class, 'account'])->name('account')->middleware('auth');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'postRegister'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Adminpanel routes
Route::group(['prefix' => '/adminpanel', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('adminpanel');

    // Format
    Route::group(['prefix' => 'formats'], function() {
        Route::get('/', [FormatController::class, 'index'])->name('adminpanel.formats');
        Route::post('/', [FormatController::class, 'store'])->name('adminpanel.format.store');
        Route::delete('/{id}', [FormatController::class, 'destroy'])->name('adminpanel.format.destroy');
        Route::patch('/{id}', [FormatController::class, 'restore'])->name('adminpanel.format.restore');
    });

    // Condition
    Route::group(['prefix' => 'conditions'], function() {
        Route::get('/', [ConditionController::class, 'index'])->name('adminpanel.conditions');
        Route::post('/', [ConditionController::class, 'store'])->name('adminpanel.condition.store');
        Route::delete('/{id}', [ConditionController::class, 'destroy'])->name('adminpanel.condition.destroy');
        Route::patch('/{id}', [ConditionController::class, 'restore'])->name('adminpanel.condition.restore');
    });

    // Genre
    Route::group(['prefix' => 'genres'], function() {
        Route::get('/', [GenreController::class, 'index'])->name('adminpanel.genres');
        Route::post('/', [GenreController::class, 'store'])->name('adminpanel.genre.store');
        Route::delete('/{id}', [GenreController::class, 'destroy'])->name('adminpanel.genre.destroy');
        Route::patch('/{id}', [GenreController::class, 'restore'])->name('adminpanel.genre.restore');
    });

    // Language
    Route::group(['prefix' => 'languages'], function() {
        Route::get('/', [LanguageController::class, 'index'])->name('adminpanel.languages');
        Route::post('/', [LanguageController::class, 'store'])->name('adminpanel.language.store');
        Route::delete('/{id}', [LanguageController::class, 'destroy'])->name('adminpanel.language.destroy');
        Route::patch('/{id}', [LanguageController::class, 'restore'])->name('adminpanel.language.restore');
    });

    // Activity Log
    Route::group(['prefix' => 'activitylog'], function() {
        Route::get('/', [ActivityLogController::class, 'index'])->name('adminpanel.activitylog');
    });
});

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
