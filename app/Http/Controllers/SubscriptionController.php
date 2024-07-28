<?php

namespace App\Http\Controllers;

use App\Models\Device;
use http\Client\Request;

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