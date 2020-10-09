<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', fn () => redirect()->route('pages.dashboard'))->name('index');

Route::group(['middleware' => 'auth'], function () {
    Route::inertia('/dashboard', 'Dashboard')->name('pages.dashboard');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('pages.login');
    Route::post('/login', [LoginController::class, 'store'])->name('pages.login');

    Route::get('/register', [RegisterController::class, 'index'])->name('pages.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('pages.register');
});
