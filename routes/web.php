<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [ProfileController::class, 'authenticate'])->name('login.post')->middleware('guest');

Route::get('/register', function () {
    // Redirect authenticated users to dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.register');
})->name('register');

Route::post('/register', [ProfileController::class, 'register'])->name('register.post')->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Masters Routes
Route::prefix('masters')->middleware('auth')->group(function () {
    // Customer CRUD Routes
    Route::resource('customers', CustomerController::class);
    Route::patch('customers/{customer}/toggle-status', [CustomerController::class, 'toggleStatus'])->name('customers.toggle-status');

    // Sites CRUD Routes
    Route::resource('sites', App\Http\Controllers\SiteController::class);
    Route::patch('sites/{site}/toggle-status', [App\Http\Controllers\SiteController::class, 'toggleStatus'])->name('sites.toggle-status');

    // Items CRUD Routes
    Route::resource('items', App\Http\Controllers\ItemController::class);
    Route::patch('items/{item}/toggle-status', [App\Http\Controllers\ItemController::class, 'toggleStatus'])->name('items.toggle-status');

    // Suppliers CRUD Routes
    Route::resource('suppliers', App\Http\Controllers\SupplierController::class);
    Route::patch('suppliers/{supplier}/toggle-status', [App\Http\Controllers\SupplierController::class, 'toggleStatus'])->name('suppliers.toggle-status');
});

// Profile & Settings Routes
Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::put('/settings', [ProfileController::class, 'updateSettings'])->name('profile.settings.update');

    Route::post('/theme', [ProfileController::class, 'updateTheme'])->name('profile.theme.update');
});

// Google OAuth
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// Password reset pages
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');

// Logout route
Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
