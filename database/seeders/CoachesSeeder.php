<?php

namespace Database\Seeders;

use App\Models\Coaches;
use Illuminate\Database\Seeder;

class CoachesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coaches::factory()
            ->count(1)
            ->create();
    }
}
