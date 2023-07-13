<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Notifications;

use App\Models\Games;
use App\Models\Practices;
use App\Models\EventTypes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_notifications(): void
    {
        $allNotifications = Notifications::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-notifications.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_notifications.index')
            ->assertViewHas('allNotifications');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_notifications(): void
    {
        $response = $this->get(route('all-notifications.create'));

        $response->assertOk()->assertViewIs('app.all_notifications.create');
    }

    /**
     * @test
     */
    public function it_stores_the_notifications(): void
    {
        $data = Notifications::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-notifications.store'), $data);

        $this->assertDatabaseHas('notifications', $data);

        $notifications = Notifications::latest('id')->first();

        $response->assertRedirect(
            route('all-notifications.edit', $notifications)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_notifications(): void
    {
        $notifications = Notifications::factory()->create();

        $response = $this->get(route('all-notifications.show', $notifications));

        $response
            ->assertOk()
            ->assertViewIs('app.all_notifications.show')
            ->assertViewHas('notifications');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_notifications(): void
    {
        $notifications = Notifications::factory()->create();

        $response = $this->get(route('all-notifications.edit', $notifications));

        $response
            ->assertOk()
            ->assertViewIs('app.all_notifications.edit')
            ->assertViewHas('notifications');
    }

    /**
     * @test
     */
    public function it_updates_the_notifications(): void
    {
        $notifications = Notifications::factory()->create();

        $games = Games::factory()->create();
        $practices = Practices::factory()->create();
        $eventTypes = EventTypes::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'message' => $this->faker->sentence(20),
            'sent_at' => $this->faker->dateTime(),
            'games_id' => $games->id,
            'practices_id' => $practices->id,
            'event_types_id' => $eventTypes->id,
        ];

        $response = $this->put(
            route('all-notifications.update', $notifications),
            $data
        );

        $data['id'] = $notifications->id;

        $this->assertDatabaseHas('notifications', $data);

        $response->assertRedirect(
            route('all-notifications.edit', $notifications)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_notifications(): void
    {
        $notifications = Notifications::factory()->create();

        $response = $this->delete(
            route('all-notifications.destroy', $notifications)
        );

        $response->assertRedirect(route('all-notifications.index'));

        $this->assertModelMissing($notifications);
    }
}
