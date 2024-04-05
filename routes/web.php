<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\LoginController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/', [LoginController::class, 'auth']);
});


Route::get('/dashboard', [DashboardAdminController::class, 'index']);
