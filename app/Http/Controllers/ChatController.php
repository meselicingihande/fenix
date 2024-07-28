<?php

namespace App\Http\Controllers;

use App\Models\Device;
use http\Client\Request;

/**
 * @OA\Post(
 *     path="/chat",
 *     tags={"Chat"},
 *     summary="Send message to ChatGPT",
 *     security={{"sanctum": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="chat_id", type="string", example="chat_123"),
 *             @OA\Property(property="message", type="string", example="Hello, ChatGPT!")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Chat message sent",
 *         @OA\JsonContent(
 *             @OA\Property(property="chat_id", type="string", example="chat_123"),
 *             @OA\Property(property="response", type="string", example="This is a response from ChatGPT")
 *         )
 *     ),
 *     @OA\Response(response=403, description="Insufficient chat credits"),
 *     @OA\Response(response=422, description="Invalid data")
 * )
 */

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