<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\EventTypes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTypesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_event_types(): void
    {
        $allEventTypes = EventTypes::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-event-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_event_types.index')
            ->assertViewHas('allEventTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_event_types(): void
    {
        $response = $this->get(route('all-event-types.create'));

        $response->assertOk()->assertViewIs('app.all_event_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_event_types(): void
    {
        $data = EventTypes::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-event-types.store'), $data);

        $this->assertDatabaseHas('event_types', $data);

        $eventTypes = EventTypes::latest('id')->first();

        $response->assertRedirect(route('all-event-types.edit', $eventTypes));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_event_types(): void
    {
        $eventTypes = EventTypes::factory()->create();

        $response = $this->get(route('all-event-types.show', $eventTypes));

        $response
            ->assertOk()
            ->assertViewIs('app.all_event_types.show')
            ->assertViewHas('eventTypes');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_event_types(): void
    {
        $eventTypes = EventTypes::factory()->create();

        $response = $this->get(route('all-event-types.edit', $eventTypes));

        $response
            ->assertOk()
            ->assertViewIs('app.all_event_types.edit')
            ->assertViewHas('eventTypes');
    }

    /**
     * @test
     */
    public function it_updates_the_event_types(): void
    {
        $eventTypes = EventTypes::factory()->create();

        $data = [
            'type' => 'game',
            'name' => $this->faker->name(),
        ];

        $response = $this->put(
            route('all-event-types.update', $eventTypes),
            $data
        );

        $data['id'] = $eventTypes->id;

        $this->assertDatabaseHas('event_types', $data);

        $response->assertRedirect(route('all-event-types.edit', $eventTypes));
    }

    /**
     * @test
     */
    public function it_deletes_the_event_types(): void
    {
        $eventTypes = EventTypes::factory()->create();

        $response = $this->delete(
            route('all-event-types.destroy', $eventTypes)
        );

        $response->assertRedirect(route('all-event-types.index'));

        $this->assertModelMissing($eventTypes);
    }
}
