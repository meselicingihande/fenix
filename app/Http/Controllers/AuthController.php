<?php

namespace App\Http\Controllers;

use App\Models\Device;
use http\Client\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'device_uuid' => 'required|uuid',
            'device_name' => 'required|string',
        ]);

        $device = Device::firstOrCreate(
            ['device_uuid' => $validated['device_uuid']],
            ['device_name' => $validated['device_name']]
        );

        return response()->json([
            'is_premium' => $device->is_premium,
            'chat_credit' => $device->chat_credit,
        ]);
    }
}