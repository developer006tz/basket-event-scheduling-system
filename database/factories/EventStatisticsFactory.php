<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\EventStatistics;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventStatisticsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventStatistics::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'points' => $this->faker->randomNumber(0),
            'rebounds' => $this->faker->randomNumber(0),
            'assists' => $this->faker->randomNumber(0),
            'blocks' => $this->faker->randomNumber(0),
            'steals' => $this->faker->randomNumber(0),
            'games_id' => \App\Models\Games::factory(),
            'players_id' => \App\Models\Players::factory(),
        ];
    }
}
