<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Auth\ManagerLoginController;
use App\Http\Controllers\Auth\DriverLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use Admin\AdminUserController;
use Admin\AdminManagerController;
use Admin\AdminLocationController;
use Admin\AdminDriverController;
use Admin\AdminCarController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::resource('/managers', AdminManagerController::class, [
        'as' => 'admin'
    ]);
    Route::resource('/drivers', AdminDriverController::class, [
        'as' => 'admin'
    ]);
    Route::resource('/users', AdminUserController::class, [
        'as' => 'admin'
    ]);
    Route::resource('/locations', AdminLocationController::class, [
        'as' => 'admin'
    ]);
    Route::resource('/cars', AdminCarController::class, [
        'as' => 'admin'
    ]);
});



Route::prefix('managers')->group(function () {
    Route::get('/login', [ManagerLoginController::class, 'showLoginForm'])->name('managers.login');
    Route::get('/home', [ManagerController::class, 'index'])->name('managers.home');
    Route::post('/logout', [ManagerLoginController::class, 'logout'])->name('managers.logout');
    Route::get('/drivers/{id}/edit', [ManagerController::class, 'editDriver'])->name('managers.edit');
    Route::get('/drivers/create', [ManagerController::class, 'create'])->name('managers.create');
});

Route::prefix('drivers')->group(function () {
    Route::get('/login', [DriverLoginController::class, 'showLoginForm'])->name('drivers.login');
    Route::get('/home', [DriverController::class, 'index'])->name('drivers.home');
    Route::get('/cars/{id}/edit', [DriverController::class, 'editCar'])->name('drivers.edit');
    Route::get('/cars/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('/logout', [DriverLoginController::class, 'logout'])->name('drivers.logout');
});
