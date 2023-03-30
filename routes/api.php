<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiStatusController;
use App\Http\Controllers\Api\ApiStatusChangeLogController;
use App\Http\Controllers\Api\LocationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/v1/login',[UserController::class, 'login']);
Route::post('v1/registration',[UserController::class, 'registration']);


Route::group(['middleware'=>['auth:sanctum','common']],function (){


    // Route::get('/getuser',[UserController::class, 'getuser']);
    Route::post('/v1/logout',[UserController::class, 'logout']);
    Route::get('/v1/getallorder',[ApiOrderController::class, 'index']);
    Route::post('/v1/placeorder',[ApiOrderController::class, 'create']);
    Route::get('/v1/getallstatus',[ApiStatusController::class, 'getallstatus']);
    Route::post('/v1/statuschangelog/{id}',[ApiStatusChangeLogController::class, 'searchwaybillapi']);
    Route::get('/v1/getlocations',[LocationController::class, 'location_get']);

});
