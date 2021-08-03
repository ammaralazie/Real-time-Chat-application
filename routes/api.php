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
    Route::get('users', [UserController::class,'getUser'])->name('user.getUser');
    Route::get('users/getUser/{value}', [UserController::class,'getSearchUser'])->name('user.getSearchUser');
});
