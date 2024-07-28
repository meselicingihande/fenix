<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition()
    {
        return [
            'chat_id' => $this->faker->uuid,
            'device_id' => \App\Models\Device::factory(),
            'message' => $this->faker->sentence,
        ];
    }
}
