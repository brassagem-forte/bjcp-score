<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('home');
})->name('home');

Route::get('/vs', [App\Http\Controllers\Dashboard::class, 'compare'])->name('compare');
Route::get('/ranking', [App\Http\Controllers\Dashboard::class, 'ranking'])->name('ranking');
Route::get('/ranking/chart', [App\Http\Controllers\Dashboard::class, 'chart'])->name('chart');
Route::get('/year/chart/{id?}', [App\Http\Controllers\Dashboard::class, 'yearChart'])->name('yearChart');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard');
    Route::get('/medals', [App\Http\Controllers\Dashboard::class, 'medals'])->name('medals');
    Route::view('profile', 'profile')->name('profile');
});
Route::get('/{id}/{slug}', [App\Http\Controllers\Dashboard::class, 'show'])->name('show');

require __DIR__ . '/auth.php';

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');
