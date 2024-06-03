<?php

namespace Database\Seeders;

use App\Models\Basket\BasketVenues;
use App\Models\Footbal\FootbalVenues;
use App\Models\Netball\NetballVenues;
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

       $footbalVenues = [
        'name'=>'Moccu Football Stadium',
        'capacity'=>34000
       ];
       FootbalVenues::create($footbalVenues);
    /**basket ball */
       $basketBallVenue = [
        'name'=>'Moccu Basket  Stadium',
        'capacity'=>1000
       ];
       BasketVenues::create($basketBallVenue);
  /** netball */
       $netballVenue = [
        'name'=>'Moccu Netball Stadium',
        'capacity'=>2000
       ];
       NetballVenues::create($netballVenue);

    }
}
