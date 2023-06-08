<?php

namespace Database\Factories;

use App\Models\EventTypes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventTypes::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'game',
            'name' => $this->faker->name(),
        ];
    }
}
