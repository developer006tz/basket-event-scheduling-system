<?php

namespace Database\Factories;

use App\Models\Games;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class GamesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Games::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'home_team_id' => \App\Models\Teams::factory(),
            'away_team_id' => \App\Models\Teams::factory(),
            'location' => $this->faker->text(15),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
        ];
    }
}
