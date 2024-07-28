<?php

namespace App\Http\Controllers;

use App\Models\Device;
use http\Client\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'chatId' => 'required|uuid',
            'message' => 'required|string',
        ]);

        $device = Device::where('device_uuid', $request->header('device_uuid'))->firstOrFail();

        if ($device->chat_credit <= 0 && !$device->is_premium) {
            return response()->json(['error' => 'Insufficient credits'], 403);
        }

        // ChatGPT bot ile konuşma mantığını burada ekle
        $response = "ChatGPT'den gelen cevap"; // Bu, gerçek bot cevabı olacak

        $chat = $device->chats()->create([
            'chat_id' => $validated['chatId'],
            'message' => $validated['message'],
            'response' => $response,
        ]);

        $device->decrement('chat_credit');

        return response()->json(['response' => $response]);
    }
}