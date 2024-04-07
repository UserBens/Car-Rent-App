<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductCarAdminController;
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
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'auth']);
});

Route::get('/home', function () {
    return redirect('/dashboard/admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [DashboardAdminController::class, 'adminindex'])->middleware('userakses:admin')->name('dashboard-admin');
    Route::resource('/dashboard/admin/car', ProductCarAdminController::class)->middleware('userakses:admin');
    Route::get('/dashboard/client', [DashboardAdminController::class, 'clientindex'])->middleware('userakses:client');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::post('/logout', [LoginController::class, 'logout']);
    // Route::get('/dashboard', [DashboardAdminController::class, 'adminindex']);
});
