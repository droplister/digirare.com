<?php

namespace App\Events;

use App\Card;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CardWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Card
     *
     * @var \App\Card
     */
    public $card;

    /**
     * Create a new event instance.
     * 
     * @param  \App\Card  $card
     * @return void
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('card-channel');
    }
}