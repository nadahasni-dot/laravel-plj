<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementUserController;
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

// Route::get('/', [ManagementUserController::class, 'index']);

Route::resource('/', HomeController::class);

// AUTH
Route::get('/auth', AuthController::class);
Route::post('/auth', [AuthController::class, 'authenticate']);

Route::get('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/signup', [AuthController::class, 'store']);

// DASHBOARD
Route::resource('/dashboard', DashboardController::class);
Route::resource('/user', ManagementUserController::class);
