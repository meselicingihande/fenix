<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test sending a chat message successfully.
     *
     * @return void
     */
    public function test_send_chat_message_successfully()
    {
        // Create a test device
        $device = Device::factory()->create();

        // Prepare the request data
        $data = [
            'chatId' => 'test-chat-id',
            'message' => 'Hello, world!',
        ];

        // Send the request
        $response = $this->actingAs($device)
            ->postJson('/api/chat', $data);

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                'response' => 'The bot’s response', // Update based on actual response
            ]);
    }

    /**
     * Test chat message with insufficient credits.
     *
     * @return void
     */
    public function test_send_chat_message_with_insufficient_credits()
    {
        // Create a test device with zero chat credits
        $device = Device::factory()->create(['chat_credits' => 0]);

        // Prepare the request data
        $data = [
            'chatId' => 'test-chat-id',
            'message' => 'Hello, world!',
        ];

        // Send the request
        $response = $this->actingAs($device)
            ->postJson('/api/chat', $data);

        // Assert the response status and structure
        $response->assertStatus(403) // or whatever status code your API returns for insufficient credits
        ->assertJson([
            'error' => 'Insufficient chat credits', // Update based on actual error response
        ]);
    }

    /**
     * Test sending a chat message with invalid data.
     *
     * @return void
     */
    public function test_send_chat_message_with_invalid_data()
    {
        // Create a test device
        $device = Device::factory()->create();

        // Prepare invalid request data
        $data = [
            'chatId' => '', // Invalid chatId
            'message' => '', // Invalid message
        ];

        // Send the request
        $response = $this->actingAs($device)
            ->postJson('/api/chat', $data);

        // Assert the response status and structure
        $response->assertStatus(422) // Validation error status
        ->assertJsonValidationErrors(['chatId', 'message']);
    }
}
