<?php

use App\Http\Controllers\ChatApp\UserController;
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

Route::group([],function () {
    Route::post('signup', [UserController::class,'signup'])->name('user.signup');
    Route::post('login', [UserController::class,'login'])->name('user.login');
    Route::get('logout', [UserController::class,'logout'])->name('user.logout');
    Route::get('users', [UserController::class,'getUser'])->name('user.getUser');
    Route::get('users/getUser/{value}', [UserController::class,'getSearchUser'])->name('user.getSearchUser');
});
