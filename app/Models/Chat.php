<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    use HasFactory;

    protected $fillable = [
        'chat_id', 'device_id', 'message', 'response'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
