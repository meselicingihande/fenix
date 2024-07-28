<?php

namespace App\Http\Controllers;

use App\Models\Device;
use http\Client\Request;

/**
 * @OA\Post(
 *     path="/auth",
 *     tags={"Authentication"},
 *     summary="Register or authenticate device",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="device_uuid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
 *             @OA\Property(property="device_name", type="string", example="User's Device")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Device authenticated",
 *         @OA\JsonContent(
 *             @OA\Property(property="is_premium", type="boolean", example=true),
 *             @OA\Property(property="chat_credits", type="integer", example=100),
 *             @OA\Property(property="chat_history", type="array", @OA\Items(type="object"))
 *         )
 *     ),
 *     @OA\Response(response=422, description="Invalid data")
 * )
 */

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'device_uuid' => 'required|string|unique:devices,device_uuid',
            'device_name' => 'required|string',
        ]);

        $device = Device::updateOrCreate(
            ['device_uuid' => $request->device_uuid],
            ['device_name' => $request->device_name]
        );

        return response()->json([
            'is_premium' => $device->is_premium,
            'chat_credits' => $device->chat_credits,
            'chat_history' => $device->chats,
        ]);
    }
}