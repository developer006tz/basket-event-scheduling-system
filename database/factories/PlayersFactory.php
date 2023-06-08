<?php

namespace Database\Factories;

use App\Models\Players;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Players::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jersey_number' => $this->faker->randomNumber(),
            'height' => $this->faker->randomFloat(2, 0, 9999),
            'weight' => $this->faker->randomFloat(2, 0, 9999),
            'age' => $this->faker->randomNumber(0),
            'teams_id' => \App\Models\Teams::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
