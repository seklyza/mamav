<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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

Route::get('/', fn () => redirect()->route('events'))->name('index');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/events', [EventsController::class, 'upcomingEvents'])->name('events');
    Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
    Route::post('/events/create', [EventsController::class, 'store'])->name('events.store');
    Route::get('/events/{id}', [EventsController::class, 'show'])->name('events.show');
    Route::get('/my-events', [EventsController::class, 'myEvents'])->name('my-events');
    Route::get('/previous-events', [EventsController::class, 'previousEvents'])->name('previous-events');
    Route::inertia('/settings', 'Settings')->name('settings');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::inertia('/register/verify', 'Register', ['success' => 'Please check your email!'])->middleware(['auth'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});
