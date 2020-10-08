<?php

use App\Http\Controllers\LoginController;
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

Route::get('/', fn () => redirect()->route('pages.login'))->name('index');
Route::get('/login', [LoginController::class, 'index'])->name('pages.login');
Route::post('/login', [LoginController::class, 'store'])->name('pages.login');
Route::inertia('/register', 'Register')->name('pages.register');
