<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['module_name', 'title', 'content', 'module_id', 'user_id'];
    public $timestamps = true;

    public function notiUsers()
    {
        return $this->hasMany(NotificationUsers::class, 'noti_id', 'id');
    }
}
