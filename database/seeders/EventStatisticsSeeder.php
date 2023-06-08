<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventStatistics;

class EventStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventStatistics::factory()
            ->count(1)
            ->create();
    }
}
