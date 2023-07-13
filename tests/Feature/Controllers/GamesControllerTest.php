<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Games;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_games(): void
    {
        $allGames = Games::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-games.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_games.index')
            ->assertViewHas('allGames');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_games(): void
    {
        $response = $this->get(route('all-games.create'));

        $response->assertOk()->assertViewIs('app.all_games.create');
    }

    /**
     * @test
     */
    public function it_stores_the_games(): void
    {
        $data = Games::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-games.store'), $data);

        $this->assertDatabaseHas('games', $data);

        $games = Games::latest('id')->first();

        $response->assertRedirect(route('all-games.edit', $games));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_games(): void
    {
        $games = Games::factory()->create();

        $response = $this->get(route('all-games.show', $games));

        $response
            ->assertOk()
            ->assertViewIs('app.all_games.show')
            ->assertViewHas('games');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_games(): void
    {
        $games = Games::factory()->create();

        $response = $this->get(route('all-games.edit', $games));

        $response
            ->assertOk()
            ->assertViewIs('app.all_games.edit')
            ->assertViewHas('games');
    }

    /**
     * @test
     */
    public function it_updates_the_games(): void
    {
        $games = Games::factory()->create();

        $data = [
            'home_team_id' => $this->faker->randomNumber(),
            'away_team_id' => $this->faker->randomNumber(),
            'location' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'result' => $this->faker->text(255),
            'result_status' => '1',
        ];

        $response = $this->put(route('all-games.update', $games), $data);

        $data['id'] = $games->id;

        $this->assertDatabaseHas('games', $data);

        $response->assertRedirect(route('all-games.edit', $games));
    }

    /**
     * @test
     */
    public function it_deletes_the_games(): void
    {
        $games = Games::factory()->create();

        $response = $this->delete(route('all-games.destroy', $games));

        $response->assertRedirect(route('all-games.index'));

        $this->assertModelMissing($games);
    }
}
