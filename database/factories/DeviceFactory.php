<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DeviceFactory extends Factory
{
    protected $model = Device::class;

    public function definition()
    {
        return [
            'device_uuid' => Str::uuid(),
            'device_name' => $this->faker->word,
            'is_premium' => $this->faker->boolean,
            'chat_credit' => $this->faker->numberBetween(0, 100),
        ];
    }
}
