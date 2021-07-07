<?php

use App\Events\ChatEvent;
use App\Http\Controllers\ChatApp\ChatsController;
use App\Http\Controllers\ChatApp\TestController;


use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){

    Route::get('messages-users','ChatsController@messages_users')->name('users.messages');
    Route::get('message/{username}','ChatsController@message_user')->name('user.message');
    Route::post('recive-message/','ChatsController@recive_message')->name('user.recive');
    Route::get('redirect_message/','ChatsController@showMessage')->name('user.redirect_message');


});//end of group


