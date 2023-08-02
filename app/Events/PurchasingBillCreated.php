<?php

namespace App\Events;

use App\Models\Purchasing;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchasingBillCreated
{
    use Dispatchable, InteractsWithSockets, Queueable, SerializesModels;

    private $purchasing;
    private $type;
    private $oldPurchasing;

    public function getPurchasing()
    {
        return $this->purchasing;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getOldPurchasing()
    {
        return $this->oldPurchasing;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($purchasing, $type, $oldPurchasing = null)
    {
        $this->purchasing = $purchasing;
        $this->type = $type;
        $this->oldPurchasing = $oldPurchasing;
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
