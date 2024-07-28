<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'device_id' => \App\Models\Device::factory(),
            'product_id' => $this->faker->word,
            'receipt_token' => $this->faker->text,
        ];
    }
}
