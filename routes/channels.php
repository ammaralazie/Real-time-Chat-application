<?php

use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-private.{id}.{id}', function () {
    return true;
});
