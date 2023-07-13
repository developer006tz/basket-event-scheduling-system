<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Teams;

use App\Models\Coaches;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamsControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_teams(): void
    {
        $allTeams = Teams::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-teams.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_teams.index')
            ->assertViewHas('allTeams');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_teams(): void
    {
        $response = $this->get(route('all-teams.create'));

        $response->assertOk()->assertViewIs('app.all_teams.create');
    }

    /**
     * @test
     */
    public function it_stores_the_teams(): void
    {
        $data = Teams::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-teams.store'), $data);

        $this->assertDatabaseHas('teams', $data);

        $teams = Teams::latest('id')->first();

        $response->assertRedirect(route('all-teams.edit', $teams));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_teams(): void
    {
        $teams = Teams::factory()->create();

        $response = $this->get(route('all-teams.show', $teams));

        $response
            ->assertOk()
            ->assertViewIs('app.all_teams.show')
            ->assertViewHas('teams');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_teams(): void
    {
        $teams = Teams::factory()->create();

        $response = $this->get(route('all-teams.edit', $teams));

        $response
            ->assertOk()
            ->assertViewIs('app.all_teams.edit')
            ->assertViewHas('teams');
    }

    /**
     * @test
     */
    public function it_updates_the_teams(): void
    {
        $teams = Teams::factory()->create();

        $coaches = Coaches::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'location' => $this->faker->text(255),
            'coaches_id' => $coaches->id,
        ];

        $response = $this->put(route('all-teams.update', $teams), $data);

        $data['id'] = $teams->id;

        $this->assertDatabaseHas('teams', $data);

        $response->assertRedirect(route('all-teams.edit', $teams));
    }

    /**
     * @test
     */
    public function it_deletes_the_teams(): void
    {
        $teams = Teams::factory()->create();

        $response = $this->delete(route('all-teams.destroy', $teams));

        $response->assertRedirect(route('all-teams.index'));

        $this->assertModelMissing($teams);
    }
}
