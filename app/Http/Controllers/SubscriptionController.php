<?php

namespace App\Http\Controllers;

use App\Models\Device;
use http\Client\Request;

/**
 * @OA\Post(
 *     path="/subscription",
 *     tags={"Subscription"},
 *     summary="Subscribe device to premium",
 *     security={{"sanctum": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="product_id", type="string", example="prod_123"),
 *             @OA\Property(property="receipt_token", type="string", example="some-long-receipt-token")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscription successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     ),
 *     @OA\Response(response=422, description="Invalid data")
 * )
 */

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'productId' => 'required|string',
            'receiptToken' => 'required|string',
        ]);

        $device = Device::where('device_uuid', $request->header('device_uuid'))->firstOrFail();

        $subscription = $device->subscriptions()->create([
            'product_id' => $validated['productId'],
            'receipt_token' => $validated['receiptToken'],
        ]);

        $device->update([
            'is_premium' => true,
            'chat_credit' => $device->chat_credit + 100, // Örneğin 100 kredi ekleyelim
        ]);

        return response()->json(['status' => 'success']);
    }
}