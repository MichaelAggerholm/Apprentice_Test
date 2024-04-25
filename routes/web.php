<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Pages routes
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/all-books', [PagesController::class, 'allBooks'])->name('allBooks');
Route::get('/cart', [PagesController::class, 'cart'])->name('cart');
Route::get('/book/{id}', [PagesController::class, 'book'])->name('book');
Route::get('/account', [PagesController::class, 'account'])->name('account')->middleware('auth');
Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('/success', [PagesController::class, 'success'])->name('success');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'postRegister'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Cart routes
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/remove-from-cart/{key}', [CartController::class, 'removeFromCart'])->name('removeFromCart');

// Checkout routes
Route::post('/stripe-checkout', [CheckoutController::class, 'stripeCheckout'])->name('stripeCheckout')->middleware('auth');

// Adminpanel routes
Route::group(['prefix' => '/adminpanel', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('adminpanel');

    // Format routes
    Route::group(['prefix' => 'formats'], function() {
        Route::get('/', [FormatController::class, 'index'])->name('adminpanel.formats');
        Route::post('/', [FormatController::class, 'store'])->name('adminpanel.format.store');
        Route::delete('/{id}', [FormatController::class, 'destroy'])->name('adminpanel.format.destroy');
        Route::patch('/{id}', [FormatController::class, 'restore'])->name('adminpanel.format.restore');
    });

    // Condition routes
    Route::group(['prefix' => 'conditions'], function() {
        Route::get('/', [ConditionController::class, 'index'])->name('adminpanel.conditions');
        Route::post('/', [ConditionController::class, 'store'])->name('adminpanel.condition.store');
        Route::delete('/{id}', [ConditionController::class, 'destroy'])->name('adminpanel.condition.destroy');
        Route::patch('/{id}', [ConditionController::class, 'restore'])->name('adminpanel.condition.restore');
    });

    // Genre routes
    Route::group(['prefix' => 'genres'], function() {
        Route::get('/', [GenreController::class, 'index'])->name('adminpanel.genres');
        Route::post('/', [GenreController::class, 'store'])->name('adminpanel.genre.store');
        Route::delete('/{id}', [GenreController::class, 'destroy'])->name('adminpanel.genre.destroy');
        Route::patch('/{id}', [GenreController::class, 'restore'])->name('adminpanel.genre.restore');
    });

    // Language routes
    Route::group(['prefix' => 'languages'], function() {
        Route::get('/', [LanguageController::class, 'index'])->name('adminpanel.languages');
        Route::get('/{id}/edit', [LanguageController::class, 'edit'])->name('adminpanel.language.edit');
        Route::post('/', [LanguageController::class, 'store'])->name('adminpanel.language.store');
        Route::put('/{id}', [LanguageController::class, 'update'])->name('adminpanel.language.update');
        Route::delete('/{id}', [LanguageController::class, 'destroy'])->name('adminpanel.language.destroy');
        Route::patch('/{id}', [LanguageController::class, 'restore'])->name('adminpanel.language.restore');
    });

    // Author routes
    Route::group(['prefix' => 'authors'], function() {
        Route::get('/', [AuthorController::class, 'index'])->name('adminpanel.authors');
        Route::get('/{id}/edit', [AuthorController::class, 'edit'])->name('adminpanel.author.edit');
        Route::put('/{id}', [AuthorController::class, 'update'])->name('adminpanel.author.update');
        Route::post('/', [AuthorController::class, 'store'])->name('adminpanel.author.store');
        Route::delete('/{id}', [AuthorController::class, 'destroy'])->name('adminpanel.author.destroy');
        Route::patch('/{id}', [AuthorController::class, 'restore'])->name('adminpanel.author.restore');
    });

    // Publisher routes
    Route::group(['prefix' => 'publishers'], function() {
        Route::get('/', [PublisherController::class, 'index'])->name('adminpanel.publishers');
        Route::post('/', [PublisherController::class, 'store'])->name('adminpanel.publisher.store');
        Route::delete('/{id}', [PublisherController::class, 'destroy'])->name('adminpanel.publisher.destroy');
        Route::patch('/{id}', [PublisherController::class, 'restore'])->name('adminpanel.publisher.restore');
    });

    // Book routes
    Route::group(['prefix' => 'books'], function() {
        Route::get('/', [BookController::class, 'index'])->name('adminpanel.books');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('adminpanel.book.edit');
        Route::put('/{id}', [BookController::class, 'update'])->name('adminpanel.book.update');
        Route::post('/', [BookController::class, 'store'])->name('adminpanel.book.store');
        Route::delete('/{id}', [BookController::class, 'destroy'])->name('adminpanel.book.destroy');
        Route::patch('/{id}', [BookController::class, 'restore'])->name('adminpanel.book.restore');
        Route::get('/import', [BookController::class, 'import'])->name('adminpanel.book.import');
    });

    // Activity Log
    Route::group(['prefix' => 'activitylog'], function() {
        Route::get('/', [ActivityLogController::class, 'index'])->name('adminpanel.activitylog');
        Route::get('/export', [ActivityLogController::class, 'export'])->name('adminpanel.activitylog.export');
    });

    // Order routes
    Route::group(['prefix' => 'orders'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('adminpanel.orders');
        Route::get('/{id}', [OrderController::class, 'view'])->name('adminpanel.orders.view');
        Route::post('/{id}', [OrderController::class, 'updateStatus'])->name('adminpanel.order.status.update');
    });

    // User routes
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UserController::class, 'index'])->name('adminpanel.users');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('adminpanel.user.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('adminpanel.user.update');
        Route::post('/', [UserController::class, 'store'])->name('adminpanel.user.store');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('adminpanel.user.destroy');
        Route::patch('/{id}', [UserController::class, 'restore'])->name('adminpanel.user.restore');
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
