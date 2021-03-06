<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventsTypingIndicator implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 public $message,$sender_id,$reciever_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg,$sender,$reciever)
    {
  $this->sender_id=$sender;
  $this->reciever_id=$reciever;
   $this->message=$msg;

    }


  public function broadcastOn()
  {
      return ['my-typing'];
  }

  public function broadcastAs()
  {
      return 'my-typing';
  }
}
