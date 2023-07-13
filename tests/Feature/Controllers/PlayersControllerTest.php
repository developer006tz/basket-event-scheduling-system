<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Players;

use App\Models\Teams;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayersControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_players(): void
    {
        $allPlayers = Players::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-players.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_players.index')
            ->assertViewHas('allPlayers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_players(): void
    {
        $response = $this->get(route('all-players.create'));

        $response->assertOk()->assertViewIs('app.all_players.create');
    }

    /**
     * @test
     */
    public function it_stores_the_players(): void
    {
        $data = Players::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-players.store'), $data);

        $this->assertDatabaseHas('players', $data);

        $players = Players::latest('id')->first();

        $response->assertRedirect(route('all-players.edit', $players));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_players(): void
    {
        $players = Players::factory()->create();

        $response = $this->get(route('all-players.show', $players));

        $response
            ->assertOk()
            ->assertViewIs('app.all_players.show')
            ->assertViewHas('players');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_players(): void
    {
        $players = Players::factory()->create();

        $response = $this->get(route('all-players.edit', $players));

        $response
            ->assertOk()
            ->assertViewIs('app.all_players.edit')
            ->assertViewHas('players');
    }

    /**
     * @test
     */
    public function it_updates_the_players(): void
    {
        $players = Players::factory()->create();

        $teams = Teams::factory()->create();
        $user = User::factory()->create();

        $data = [
            'jersey_number' => $this->faker->randomNumber(),
            'height' => $this->faker->randomFloat(2, 0, 9999),
            'weight' => $this->faker->randomFloat(2, 0, 9999),
            'age' => $this->faker->randomNumber(0),
            'teams_id' => $teams->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('all-players.update', $players), $data);

        $data['id'] = $players->id;

        $this->assertDatabaseHas('players', $data);

        $response->assertRedirect(route('all-players.edit', $players));
    }

    /**
     * @test
     */
    public function it_deletes_the_players(): void
    {
        $players = Players::factory()->create();

        $response = $this->delete(route('all-players.destroy', $players));

        $response->assertRedirect(route('all-players.index'));

        $this->assertModelMissing($players);
    }
}
