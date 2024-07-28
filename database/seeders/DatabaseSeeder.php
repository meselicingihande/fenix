<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\Subscription;
use App\Models\Chat;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed the devices
        Device::factory()->count(50)->create();

        // Seed the subscriptions
        Subscription::factory()->count(100)->create();

        // Seed the chats
        Chat::factory()->count(200)->create();
    }
}
