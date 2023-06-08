<?php

namespace Database\Seeders;

use App\Models\Practices;
use Illuminate\Database\Seeder;

class PracticesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Practices::factory()
            ->count(1)
            ->create();
    }
}
