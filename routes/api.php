<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\DriverLoginController;
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

Route::post('/drivers/logout',[DriverLoginController::class,'logout']);
Route::post('/drivers/login',[DriverLoginController::class,'login']);
Route::get('/drivers/getCars/{id}',[DriversController::class,'getCars']);
Route::get('/drivers/getCar/{id}',[DriversController::class,'getCar']);
Route::post('/drivers/setCar/{id}',[DriversController::class,'setCar']);
Route::post('/drivers/destroy/{id}',[DriversController::class,'destroy']);
Route::post('/drivers/createCar',[DriversController::class,'store']);
