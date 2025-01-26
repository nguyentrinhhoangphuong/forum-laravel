<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/signin', [LandingController::class, 'signin'])->name('landing.signin');
Route::get('/signup', [LandingController::class, 'signup'])->name('landing.signup');
Route::post('/signin', [LandingController::class, 'signincheck']);
Route::post('/signup', [LandingController::class, 'signupcheck']);
Route::post('/logout', [LandingController::class, 'logout'])->name('logout');
Route::get('/dashboard/{info}', [UserController::class, 'dashboard'])->name('user.dashboard');
