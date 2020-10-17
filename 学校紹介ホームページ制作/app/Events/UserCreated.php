<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct(\App\User $user)  //무조건 실행되는 부분 
    {
        $this->user = $user;   //이 이벤트를 명시해 놓은 곳은
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
