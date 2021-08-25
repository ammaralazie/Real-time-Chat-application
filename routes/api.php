<?php

use App\Http\Controllers\ChatApp\ChatsController;
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

    //UserController
    Route::post('signup', [UserController::class,'signup'])->name('user.signup');
    Route::post('login', [UserController::class,'login'])->name('user.login');
    Route::get('logout', [UserController::class,'logout'])->name('user.logout');

    Route::post("forgot",[UserController::class,'forgotPassword'])->name('forgot.user');
    Route::post('tokenValidation',[UserController::class,'tokenValidation'])->name('token.user');
    Route::post('reset-password',[UserController::class,'resetPassword'])->name('resetPaswword.user');

    Route::get('users', [UserController::class,'getUser'])->name('user.getUser');
    Route::get('users/getUser/{value}', [UserController::class,'getSearchUser'])->name('user.getSearchUser');

    //Chats Controller
    Route::get('messages-users',[ChatsController::class,'messages_users'])->name('users.messages');
    Route::post('message/',[ChatsController::class,'message_user'])->name('user.message');
    Route::post('recive-message/',[ChatsController::class,'recive_message'])->name('user.recive');
});
