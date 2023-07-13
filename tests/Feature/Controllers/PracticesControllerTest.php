<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Practices;

use App\Models\Teams;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PracticesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_practices(): void
    {
        $allPractices = Practices::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-practices.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_practices.index')
            ->assertViewHas('allPractices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_practices(): void
    {
        $response = $this->get(route('all-practices.create'));

        $response->assertOk()->assertViewIs('app.all_practices.create');
    }

    /**
     * @test
     */
    public function it_stores_the_practices(): void
    {
        $data = Practices::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-practices.store'), $data);

        $this->assertDatabaseHas('practices', $data);

        $practices = Practices::latest('id')->first();

        $response->assertRedirect(route('all-practices.edit', $practices));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_practices(): void
    {
        $practices = Practices::factory()->create();

        $response = $this->get(route('all-practices.show', $practices));

        $response
            ->assertOk()
            ->assertViewIs('app.all_practices.show')
            ->assertViewHas('practices');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_practices(): void
    {
        $practices = Practices::factory()->create();

        $response = $this->get(route('all-practices.edit', $practices));

        $response
            ->assertOk()
            ->assertViewIs('app.all_practices.edit')
            ->assertViewHas('practices');
    }

    /**
     * @test
     */
    public function it_updates_the_practices(): void
    {
        $practices = Practices::factory()->create();

        $teams = Teams::factory()->create();

        $data = [
            'location' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'teams_id' => $teams->id,
        ];

        $response = $this->put(
            route('all-practices.update', $practices),
            $data
        );

        $data['id'] = $practices->id;

        $this->assertDatabaseHas('practices', $data);

        $response->assertRedirect(route('all-practices.edit', $practices));
    }

    /**
     * @test
     */
    public function it_deletes_the_practices(): void
    {
        $practices = Practices::factory()->create();

        $response = $this->delete(route('all-practices.destroy', $practices));

        $response->assertRedirect(route('all-practices.index'));

        $this->assertModelMissing($practices);
    }
}
