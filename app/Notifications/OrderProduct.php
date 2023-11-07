<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderProduct extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;
    protected $time;
    protected $followers;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $time)
    {
        $this->onConnection("redis");
        $this->message = $message;
        $this->time = $time;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'time' => date('H:i d/m/Y', strtotime($this->time)),
        ];
    }
}
