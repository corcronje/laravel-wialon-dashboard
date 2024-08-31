<?php

namespace Tests\Feature;

use App\Models\Pump;
use Tests\TestCase;

class PumpTest extends TestCase
{
    public function test_a_user_can_see_the_pump_index_page(): void
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('pumps.index'));

        $response->assertStatus(200);

        $response->assertViewIs('pumps.index');
    }

    public function test_a_user_cannot_see_the_pump_create_page(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('pumps.create'));

        $response->assertStatus(403);
    }

    public function test_an_admin_user_can_see_the_pump_create_page(): void {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->get(route('pumps.create'));

        $response->assertStatus(200);

        $response->assertViewIs('pumps.create');
    }

    public function test_an_admin_user_can_create_a_pump(): void {
        $user = $this->newAdminUser();

        $data = Pump::factory()->make();

        $response = $this->actingAs($user)->post(route('pumps.store'), $data->toArray());

        $response->assertRedirect(route('pumps.index'));

        $this->assertDatabaseHas('pumps', $data->toArray());
    }

    public function test_a_user_cannot_create_a_pump(): void {
        $user = $this->newUser();

        $data = Pump::factory()->make();

        $response = $this->actingAs($user)->post(route('pumps.store'), $data->toArray());

        $response->assertStatus(403);
    }

    public function test_an_admin_user_can_see_the_pump_edit_page(): void {
        $user = $this->newAdminUser();

        $pump = Pump::factory()->create();

        $response = $this->actingAs($user)->get(route('pumps.edit', $pump->id));

        $response->assertStatus(200);

        $response->assertViewIs('pumps.edit');
    }

    public function test_a_user_cannot_see_the_pump_edit_page(): void {
        $user = $this->newUser();

        $pump = Pump::factory()->create();

        $response = $this->actingAs($user)->get(route('pumps.edit', $pump->id));

        $response->assertStatus(403);
    }

    public function test_an_admin_user_can_update_a_pump(): void {
        $user = $this->newAdminUser();

        $pump = Pump::factory()->create();

        $data = Pump::factory()->make();

        $response = $this->actingAs($user)->put(route('pumps.update', $pump->id), $data->toArray());

        $response->assertRedirect(route('pumps.index'));

        $this->assertDatabaseHas('pumps', $data->toArray());
    }

    public function test_a_user_cannot_update_a_pump(): void {
        $user = $this->newUser();

        $pump = Pump::factory()->create();

        $data = Pump::factory()->make();

        $response = $this->actingAs($user)->put(route('pumps.update', $pump->id), $data->toArray());

        $response->assertStatus(403);
    }

    public function test_an_admin_user_can_delete_a_pump(): void {
        $user = $this->newAdminUser();

        $pump = Pump::factory()->create();

        $response = $this->actingAs($user)->delete(route('pumps.destroy', $pump->id));

        $response->assertRedirect(route('pumps.index'));
    }

    public function test_a_user_cannot_delete_a_pump(): void {
        $user = $this->newUser();

        $pump = Pump::factory()->create();

        $response = $this->actingAs($user)->delete(route('pumps.destroy', $pump->id));

        $response->assertStatus(403);
    }
}
