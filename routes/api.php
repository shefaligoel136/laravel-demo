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
Route::get('user',[AuthController::class,'user'])->middleware('logRoute');

Route::post('register',[AuthController::class,'register'])->middleware('logRoute');
Route::post('login',[AuthController::class,'login'])->middleware('logRoute');

Route::group(['prefix'=>'users'],function(){
    Route::get('/trash', [UserController::class,'trash'])->middleware('logRoute');
    Route::post('/restore/{id}', [UserController::class,'restore'])->middleware('logRoute');
    Route::delete('/force-delete/{id}', [UserController::class,'forceDelete'])->middleware('logRoute');
});
Route::resource('users', UserController::class)->middleware(('logRoute'));


Route::middleware(['auth:sanctum','logRoute'])->group(function () {
    Route::get('me', [\App\Http\Controllers\AuthController::class, 'me'])->middleware(('logRoute'));
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware(('logRoute'));

    Route::resource('skillBuilder', SkillBuilderController::class)->middleware(('logRoute'));

});

// complex datatype
// relations
// log files 
// roles
// permissions 