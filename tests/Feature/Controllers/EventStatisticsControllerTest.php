<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\EventStatistics;

use App\Models\Games;
use App\Models\Players;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventStatisticsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_event_statistics(): void
    {
        $allEventStatistics = EventStatistics::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-event-statistics.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_event_statistics.index')
            ->assertViewHas('allEventStatistics');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_event_statistics(): void
    {
        $response = $this->get(route('all-event-statistics.create'));

        $response->assertOk()->assertViewIs('app.all_event_statistics.create');
    }

    /**
     * @test
     */
    public function it_stores_the_event_statistics(): void
    {
        $data = EventStatistics::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-event-statistics.store'), $data);

        $this->assertDatabaseHas('event_statistics', $data);

        $eventStatistics = EventStatistics::latest('id')->first();

        $response->assertRedirect(
            route('all-event-statistics.edit', $eventStatistics)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_event_statistics(): void
    {
        $eventStatistics = EventStatistics::factory()->create();

        $response = $this->get(
            route('all-event-statistics.show', $eventStatistics)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_event_statistics.show')
            ->assertViewHas('eventStatistics');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_event_statistics(): void
    {
        $eventStatistics = EventStatistics::factory()->create();

        $response = $this->get(
            route('all-event-statistics.edit', $eventStatistics)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_event_statistics.edit')
            ->assertViewHas('eventStatistics');
    }

    /**
     * @test
     */
    public function it_updates_the_event_statistics(): void
    {
        $eventStatistics = EventStatistics::factory()->create();

        $games = Games::factory()->create();
        $players = Players::factory()->create();

        $data = [
            'points' => $this->faker->randomNumber(0),
            'rebounds' => $this->faker->randomNumber(0),
            'assists' => $this->faker->randomNumber(0),
            'blocks' => $this->faker->randomNumber(0),
            'steals' => $this->faker->randomNumber(0),
            'games_id' => $games->id,
            'players_id' => $players->id,
        ];

        $response = $this->put(
            route('all-event-statistics.update', $eventStatistics),
            $data
        );

        $data['id'] = $eventStatistics->id;

        $this->assertDatabaseHas('event_statistics', $data);

        $response->assertRedirect(
            route('all-event-statistics.edit', $eventStatistics)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_event_statistics(): void
    {
        $eventStatistics = EventStatistics::factory()->create();

        $response = $this->delete(
            route('all-event-statistics.destroy', $eventStatistics)
        );

        $response->assertRedirect(route('all-event-statistics.index'));

        $this->assertModelMissing($eventStatistics);
    }
}
