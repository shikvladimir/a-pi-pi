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

Route::post('login', [AuthController::class, 'authenticate'])->name('user.authenticate');
Route::get('get_user', [AuthController::class, 'get_user']);


Route::group(['middleware' => ['jwt.verify','check.role']], function() {
    Route::post('register', [UserController::class, 'register'])->name('admin.register');
    Route::put('update/{id}',  [UserController::class, 'update'])->name('admin.update');
    Route::post('delete',  [UserController::class, 'delete'])->name('admin.delete');
});

Route::get('error', function (){
    return response(['message' => 'User not found'])->name('error');
});
