<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUsers extends Model
{
    use HasFactory;
    protected $table = 'notification_users';
    protected $fillable = ['noti_id', 'user_id', 'read_at'];
    public $timestamps = false;
}
