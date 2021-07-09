<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg,$sndUsr,$rcvUsr;
    public function __construct($msg,$rcvUsr,$sndUsr)
    {
        $this->msg=$msg;
        $this->sndUsr=$sndUsr;
        $this->rcvUsr=$rcvUsr;
    }//end of constructr

    public function broadcastOn()
    {
        return new PrivateChannel('chat-prvate.'.$this->sndUsr.'.'.$this->rcvUsr);

    }// end broadcastOn

    public function broadcastAs()
    {
        return 'chat-p';
    }// end broadcastAs
}
