<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ManagersController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\DriversController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getBrandCars',[HomeController::class, 'getBrandCars']);
Route::post('/getCars',[HomeController::class, 'getCars']);
Route::get('/drivers/getCars/{id}',[DriversController::class,'getCars']);
Route::get('/drivers/getCar/{id}',[DriversController::class,'getCar']);
Route::post('/drivers/setCar/{id}',[DriversController::class,'setCar']);
Route::post('/drivers/destroy/{id}',[DriversController::class,'destroy']);
Route::post('/drivers/createCar',[DriversController::class,'store']);

Route::get('/managers/getDrivers/{id}',[ManagersController::class,'getDrivers']);
Route::get('/managers/getDriver/{id}',[ManagersController::class,'getDriver']);
Route::get('/managers/getCars/{id}',[ManagersController::class,'getCars']);
Route::post('/managers/setDriver/{id}',[ManagersController::class,'setDriver']);
Route::post('/managers/destroy/{id}',[ManagersController::class,'destroy']);
Route::post('/managers/createDriver',[ManagersController::class,'store']);
