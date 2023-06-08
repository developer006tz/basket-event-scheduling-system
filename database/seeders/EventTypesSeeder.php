<?php

namespace Database\Seeders;

use App\Models\EventTypes;
use Illuminate\Database\Seeder;

class EventTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventTypes::factory()
            ->count(1)
            ->create();
    }
}
