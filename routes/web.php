<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ParticipantController;
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
    Route::prefix('/events')->name('events')->group(function () {
        Route::get('', [EventController::class, 'upcomingEvents'])->name('');
        Route::get('/create', [EventController::class, 'create'])->name('.create');
        Route::post('/create', [EventController::class, 'store'])->name('.store');

        Route::delete('/{event}', [EventController::class, 'delete'])->name('.delete');
        Route::get('/{event}', [EventController::class, 'show'])->name('.show');

        Route::prefix('/{event}')->middleware('can:update,event')->group(function () {
            Route::post('/link', [EventController::class, 'generateLink'])
                ->name('.generate-link');
            Route::delete('/participants/{participant}', [ParticipantController::class, 'delete'])
                ->name('.participants.delete');
            Route::post('/participants/{participant}/make-organizer', [ParticipantController::class, 'makeOrganizer'])
                ->name('.participants.make-organizer');
        });
    });

    Route::get('/my-events', [EventController::class, 'myEvents'])->name('my-events');
    Route::get('/previous-events', [EventController::class, 'previousEvents'])->name('previous-events');
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
