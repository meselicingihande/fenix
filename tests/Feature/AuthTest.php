<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful device authentication.
     *
     * @return void
     */
    public function test_successful_device_authentication()
    {
        // Create a test device
        $device = Device::factory()->create();

        // Prepare the request data
        $data = [
            'device_uuid' => $device->device_uuid,
            'device_name' => $device->device_name,
        ];

        // Send the request
        $response = $this->postJson('/api/auth', $data);

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                'subscription_status' => $device->is_premium ? 'premium' : 'free',
                'chat_credits' => $device->chat_credits,
                'chat_history' => $device->chat_history, // Adjust based on actual response structure
            ]);
    }

    /**
     * Test device authentication with missing data.
     *
     * @return void
     */
    public function test_device_authentication_with_missing_data()
    {
        // Prepare invalid request data
        $data = [
            'device_uuid' => '', // Missing UUID
            'device_name' => '', // Missing device name
        ];

        // Send the request
        $response = $this->postJson('/api/auth', $data);

        // Assert the response status and structure
        $response->assertStatus(422) // Validation error status
        ->assertJsonValidationErrors(['device_uuid', 'device_name']);
    }

    /**
     * Test device authentication with non-existent device.
     *
     * @return void
     */
    public function test_device_authentication_with_non_existent_device()
    {
        // Prepare request data for a non-existent device
        $data = [
            'device_uuid' => 'non-existent-uuid',
            'device_name' => 'Non-existent Device',
        ];

        // Send the request
        $response = $this->postJson('/api/auth', $data);

        // Assert the response status and structure
        $response->assertStatus(404) // or appropriate status code for non-existent device
        ->assertJson([
            'error' => 'Device not found', // Adjust based on actual error message
        ]);
    }
}
