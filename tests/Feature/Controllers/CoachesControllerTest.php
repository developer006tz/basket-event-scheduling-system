<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Coaches;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CoachesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_coaches(): void
    {
        $allCoaches = Coaches::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-coaches.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_coaches.index')
            ->assertViewHas('allCoaches');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_coaches(): void
    {
        $response = $this->get(route('all-coaches.create'));

        $response->assertOk()->assertViewIs('app.all_coaches.create');
    }

    /**
     * @test
     */
    public function it_stores_the_coaches(): void
    {
        $data = Coaches::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-coaches.store'), $data);

        $this->assertDatabaseHas('coaches', $data);

        $coaches = Coaches::latest('id')->first();

        $response->assertRedirect(route('all-coaches.edit', $coaches));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_coaches(): void
    {
        $coaches = Coaches::factory()->create();

        $response = $this->get(route('all-coaches.show', $coaches));

        $response
            ->assertOk()
            ->assertViewIs('app.all_coaches.show')
            ->assertViewHas('coaches');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_coaches(): void
    {
        $coaches = Coaches::factory()->create();

        $response = $this->get(route('all-coaches.edit', $coaches));

        $response
            ->assertOk()
            ->assertViewIs('app.all_coaches.edit')
            ->assertViewHas('coaches');
    }

    /**
     * @test
     */
    public function it_updates_the_coaches(): void
    {
        $coaches = Coaches::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
        ];

        $response = $this->put(route('all-coaches.update', $coaches), $data);

        $data['id'] = $coaches->id;

        $this->assertDatabaseHas('coaches', $data);

        $response->assertRedirect(route('all-coaches.edit', $coaches));
    }

    /**
     * @test
     */
    public function it_deletes_the_coaches(): void
    {
        $coaches = Coaches::factory()->create();

        $response = $this->delete(route('all-coaches.destroy', $coaches));

        $response->assertRedirect(route('all-coaches.index'));

        $this->assertModelMissing($coaches);
    }
}
