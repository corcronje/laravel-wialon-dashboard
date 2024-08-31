<?php

namespace Tests\Feature;

use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use WithFaker;

    public function test_index_page_can_be_seen_by_a_user(): void
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('drivers.index'));

        $response->assertStatus(200);
    }

    public function test_a_user_can_see_a_driver(): void
    {
        $user = $this->newUser();

        $driver = Driver::factory()->create();

        $response = $this->actingAs($user)->get(route('drivers.show', $driver->id));

        $response->assertStatus(200);
    }

    public function test_create_page_can_be_seen_by_an_admin_user(): void
    {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->get(route('drivers.create'));

        $response->assertStatus(200);
    }

    public function test_create_page_cannot_be_seen_by_a_user(): void
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('drivers.create'));

        $response->assertStatus(403);
    }

    public function test_driver_can_be_created_by_an_admin_user(): void
    {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->post(route('drivers.store'), [
            'name' => $this->faker->name,
            'employee_number' => $this->faker->randomNumber(8),
        ]);

        $response->assertStatus(302);
    }

    public function test_driver_cannot_be_created_by_a_user(): void
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->post(route('drivers.store'), [
            'name' => $this->faker->name,
            'employee_number' => $this->faker->randomNumber(8),
        ]);

        $response->assertStatus(403);
    }

    public function test_edit_page_can_be_seen_by_an_admin_user(): void
    {
        $user = $this->newAdminUser();

        $driver = Driver::factory()->create();

        $response = $this->actingAs($user)->get(route('drivers.edit', $driver->id));

        $response->assertStatus(200);
    }

    public function test_edit_page_cannot_be_seen_by_a_user(): void
    {
        $user = $this->newUser();

        $driver = Driver::factory()->create();

        $response = $this->actingAs($user)->get(route('drivers.edit', $driver->id));

        $response->assertStatus(403);
    }

    public function test_driver_can_be_updated_by_an_admin_user(): void
    {
        $user = $this->newAdminUser();

        $driver = Driver::factory()->create();

        $response = $this->actingAs($user)->put(route('drivers.update', $driver->id), [
            'name' => $this->faker->name,
            'employee_number' => $this->faker->randomNumber(8),
        ]);

        $response->assertStatus(302);
    }

    public function test_driver_cannot_be_updated_by_a_user(): void
    {
        $user = $this->newUser();

        $driver = Driver::factory()->create();

        $response = $this->actingAs($user)->put(route('drivers.update', $driver->id), [
            'name' => $this->faker->name,
            'employee_number' => $this->faker->randomNumber(8),
        ]);

        $response->assertStatus(403);
    }

    public function test_driver_can_be_deleted_by_an_admin_user(): void
    {
        $user = $this->newAdminUser();

        $driver = Driver::factory()->create();

        $response = $this->actingAs($user)->delete(route('drivers.destroy', $driver->id));

        $response->assertStatus(302);
    }

    public function test_driver_cannot_be_deleted_by_a_user(): void
    {
        $user = $this->newUser();

        $driver = Driver::factory()->create();

        $response = $this->actingAs($user)->delete(route('drivers.destroy', $driver->id));

        $response->assertStatus(403);
    }
}
