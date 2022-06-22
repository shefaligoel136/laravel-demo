<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Mapping string as a path to this file
Route::get('user',[AuthController::class,'user']);

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [\App\Http\Controllers\AuthController::class, 'me']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

// complex datatype
// relations
// log files 
// roles
// permissions 