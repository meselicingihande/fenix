<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_authenticate()
    {
        $response = $this->post('/api/auth', [
            'device_uuid' => '1234-5678-91011',
            'device_name' => 'Test Device',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'is_premium',
                'chat_credit',
            ],
        ]);
    }
}
