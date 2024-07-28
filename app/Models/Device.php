<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_uuid', 'device_name', 'is_premium', 'chat_credit'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
