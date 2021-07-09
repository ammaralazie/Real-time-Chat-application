<?php

use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('chat-prvate.{sndUsr}.{rcvUsr}', function () {
    return true;
});
