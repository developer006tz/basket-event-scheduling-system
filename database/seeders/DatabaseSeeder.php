<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'name'=>'jimmy Mbapila',
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
                'phone'=>'0620563834',
                'maritial_status'=>'single',
                'address'=>'Moshi',
            ]);
        $this->call(PermissionsSeeder::class);

        /*$this->call(CoachesSeeder::class);
        $this->call(EventStatisticsSeeder::class);
        $this->call(EventTypesSeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(NotificationsSeeder::class);
        $this->call(PlayersSeeder::class);
        $this->call(PracticesSeeder::class);
        $this->call(TeamsSeeder::class);
        $this->call(UserSeeder::class);*/
    }
}
