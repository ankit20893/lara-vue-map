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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::post('/all-markers', [App\Http\Controllers\WelcomeController::class, 'allMarkers'])->name('all-markers');
Route::post('/common-markers', [App\Http\Controllers\WelcomeController::class, 'commonMarkers'])->name('common-markers');
Route::post('/radius-markers', [App\Http\Controllers\WelcomeController::class, 'radiusMarkers'])->name('radius-markers');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

