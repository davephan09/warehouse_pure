<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderBillCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $order;
    private $type;
    private $oldOrder;

    public function getOrder()
    {
        return $this->order;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getOldOrder()
    {
        return $this->oldOrder;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $type, $oldOrder = null)
    {
        $this->order = $order;
        $this->type = $type;
        $this->oldOrder = $oldOrder;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
