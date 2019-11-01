<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCounterEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   public $from,$to,$count;

    public function __construct($from,$to,$count)
    {
   $this->from=$from;
   $this->to=$to;
   $this->count=$count;
    }


  public function broadcastOn()
  {
      return ['message-counter-channel'];
  }

  public function broadcastAs()
  {
      return 'message-counter-event';
  }
}
