<?php

use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('chat-prvate.{id}', function () {
    return true;
});
