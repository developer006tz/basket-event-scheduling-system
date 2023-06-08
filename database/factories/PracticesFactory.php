<?php

namespace Database\Factories;

use App\Models\Practices;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PracticesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Practices::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => $this->faker->text(15),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'teams_id' => \App\Models\Teams::factory(),
        ];
    }
}
