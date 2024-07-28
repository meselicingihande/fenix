<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;
use App\Models\Subscription;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful subscription recording.
     *
     * @return void
     */
    public function test_successful_subscription_recording()
    {
        // Create a test device
        $device = Device::factory()->create();

        // Prepare the request data
        $data = [
            'productId' => 'test-product-id',
            'receiptToken' => 'test-receipt-token',
        ];

        // Send the request with device authentication
        $response = $this->actingAs($device)
            ->postJson('/api/subscription', $data);

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                'subscription_status' => 'success',
            ]);

        // Verify that the subscription was recorded
        $this->assertDatabaseHas('subscriptions', [
            'device_id' => $device->id,
            'product_id' => 'test-product-id',
            'receipt_token' => 'test-receipt-token',
        ]);
    }

    /**
     * Test subscription recording with missing data.
     *
     * @return void
     */
    public function test_subscription_recording_with_missing_data()
    {
        // Create a test device
        $device = Device::factory()->create();

        // Prepare invalid request data
        $data = [
            'productId' => '', // Missing productId
            'receiptToken' => '', // Missing receiptToken
        ];

        // Send the request with device authentication
        $response = $this->actingAs($device)
            ->postJson('/api/subscription', $data);

        // Assert the response status and structure
        $response->assertStatus(422) // Validation error status
        ->assertJsonValidationErrors(['productId', 'receiptToken']);
    }

    /**
     * Test subscription recording with invalid device.
     *
     * @return void
     */
    public function test_subscription_recording_with_invalid_device()
    {
        // Use a random device UUID not in the database
        $data = [
            'productId' => 'test-product-id',
            'receiptToken' => 'test-receipt-token',
        ];

        // Send the request with an invalid device
        $response = $this->postJson('/api/subscription', $data);

        // Assert the response status and structure
        $response->assertStatus(401) // Unauthorized status for invalid device
        ->assertJson([
            'error' => 'Invalid device', // Adjust based on actual error message
        ]);
    }
}
