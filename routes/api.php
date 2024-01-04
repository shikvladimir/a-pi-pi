<?php

use App\Http\Controllers\AuthController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [AuthController::class, 'authenticate']);
Route::get('get_user', [AuthController::class, 'get_user']);

Route::post('error', [AuthController::class, 'error'])->name('error');
//Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['jwt.verify','check.role']], function() {
    Route::post('register', [UserController::class, 'register']);
    Route::put('update/{user}',  [UserController::class, 'update']);
    Route::delete('delete/{user}',  [UserController::class, 'destroy']);
});
