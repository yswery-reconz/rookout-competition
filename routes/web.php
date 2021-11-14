<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/start', [UserController::class, 'start'])->name('start');
Route::post('/stop', [UserController::class, 'stop'])->name('stop');
Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('leaderboard');
Route::get('/success', [UserController::class, 'success'])->name('success');

Route::get('/submit-info', [UserController::class, 'submitInfo'])->name('submit-info');
Route::post('/submit-info', [UserController::class, 'doSubmitInfo']);
