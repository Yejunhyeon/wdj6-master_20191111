<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasswordRemindCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    # 메일과 토큰을 이용해서 비밀번호 재설정
    public $email, $token;

    public function __construct($email, $token)
    {
        # 이벤트 호출시 넘어온 데이터 저장
        $this->email = $email;
        $this->token = $token;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
