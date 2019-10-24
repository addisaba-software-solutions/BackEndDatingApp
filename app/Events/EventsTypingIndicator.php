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
 public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
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
