<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMessageEventForClient implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   public $from,$to,$message,$counter;

    public function __construct($from,$to,$message,$counter)
    {
   $this->from=$from;
   $this->to=$to;
   $this->message=$message;
   $this->counter=$counter;
    }


  public function broadcastOn()
  {
      return ['my-channel-client'];
  }

  public function broadcastAs()
  {
      return 'my-event-client';
  }
}
