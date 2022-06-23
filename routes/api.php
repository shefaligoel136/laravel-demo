<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillBuilderController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix'=>'users'],function(){
    Route::get('/trash', [UserController::class,'trash']);
    Route::post('/restore/{id}', [UserController::class,'restore']);
    Route::delete('/force-delete/{id}', [UserController::class,'forceDelete']);
});
Route::resource('users', UserController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [\App\Http\Controllers\AuthController::class, 'me']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::resource('skillBuilder', SkillBuilderController::class);

});

// complex datatype
// relations
// log files 
// roles
// permissions 