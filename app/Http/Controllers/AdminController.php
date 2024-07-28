<?php

namespace App\Http\Controllers;

use App\Models\Subscription;

/**
 * @OA\Get(
 *     path="/admin/subscriptions",
 *     tags={"Admin"},
 *     summary="Get subscription transactions",
 *     security={{"sanctum": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of subscription transactions",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="device_id", type="integer", example=1),
 *                 @OA\Property(property="product_id", type="string", example="prod_123"),
 *                 @OA\Property(property="receipt_token", type="string", example="some-long-receipt-token"),
 *                 @OA\Property(property="created_at", type="string", example="2023-01-01 00:00:00"),
 *                 @OA\Property(property="updated_at", type="string", example="2023-01-01 00:00:00")
 *             )
 *         )
 *     )
 * )
 */

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function getSubscriptions()
    {
        $subscriptions = Subscription::with('device')->get();
        return DataTables::of($subscriptions)->make(true);
    }
}