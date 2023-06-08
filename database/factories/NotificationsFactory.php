<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Notifications;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notifications::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'message' => $this->faker->sentence(10),
            'sent_at' => $this->faker->dateTime(),
            'games_id' => \App\Models\Games::factory(),
            'practices_id' => \App\Models\Practices::factory(),
            'event_types_id' => \App\Models\EventTypes::factory(),
        ];
    }
}
