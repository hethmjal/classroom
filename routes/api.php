<?php

use App\Http\Controllers\Api\V1\AccessTokenController;
use App\Http\Controllers\Api\V1\ClassroomController;
use App\Http\Controllers\Api\V1\ClassworksController;
<<<<<<< HEAD
use App\Http\Controllers\Api\V1\ClassroomMessagesController;
=======
use Illuminate\Http\Request;
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::middleware('guest:sanctum')->group(function () {
        Route::post('/login',[AccessTokenController::class,'store']);
    });


    Route::middleware('auth:sanctum')->group(function () {
<<<<<<< HEAD

        Route::apiResource('/classrooms',ClassroomController::class);
        Route::apiResource('classrooms.classworks',ClassworksController::class);
       


=======
        Route::apiResource('/classrooms',ClassroomController::class);
        Route::apiResource('classrooms.classworks',ClassworksController::class);
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9

        Route::get('/access-tokens',[AccessTokenController::class,'index']);
        Route::delete('/logout/{id?}',[AccessTokenController::class,'destroy']);

<<<<<<< HEAD



       
=======
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9
    });

});






<<<<<<< HEAD


=======
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9
