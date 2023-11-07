<?php
namespace App\Classes;

use App\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Auth;

class Notifications
{
    public static function listNotifications(){
        $notifications = app()->make(NotificationRepository::class)->filters([
            'limit' => 5
        ]);
        return $notifications;
    }

    public static function listNewNotifications(){
        $notifications = app()->make(NotificationRepository::class)->filters([
            'seen' => true,
        ]);
    }
}