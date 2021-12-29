<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/vs', [App\Http\Controllers\Dashboard::class, 'compare'])->name('compare');
Route::get('/ranking', [App\Http\Controllers\Dashboard::class, 'ranking'])->name('ranking');
Route::get('/ranking/chart', [App\Http\Controllers\Dashboard::class, 'chart'])->name('chart');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard');
    Route::put('/store', [App\Http\Controllers\Dashboard::class, 'store'])->name('store');
});

require __DIR__.'/auth.php';

Route::get('/{id}/{slug}', [App\Http\Controllers\Dashboard::class, 'show'])->name('show');
