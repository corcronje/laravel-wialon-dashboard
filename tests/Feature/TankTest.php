<?php

namespace Tests\Feature;

use App\Models\Tank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TankTest extends TestCase
{
    // a user can see the tank index page
    public function test_a_user_can_see_the_tank_index_page(): void
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('tanks.index'));

        $response->assertStatus(200);

        $response->assertViewIs('tanks.index');
    }

    // a user can see the tank show page
    public function test_a_user_can_see_the_tank_show_page(): void
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->get(route('tanks.show', $tank->id));

        $response->assertStatus(200);

        $response->assertViewIs('tanks.show');
    }

    // a user cannot see the tank create page
    public function test_a_user_cannot_see_the_tank_create_page(): void
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('tanks.create'));

        $response->assertStatus(403);
    }

    // an admin user can see the tank create page
    public function test_an_admin_user_can_see_the_tank_create_page(): void
    {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->get(route('tanks.create'));

        $response->assertStatus(200);

        $response->assertViewIs('tanks.create');
    }

    // an admin user can create a tank
    public function test_an_admin_user_can_create_a_tank(): void
    {
        $user = $this->newAdminUser();

        $data = Tank::factory()->make()->toArray();

        $response = $this->actingAs($user)->post(route('tanks.store'), $data);

        $response->assertRedirect(route('tanks.index'));

        $this->assertDatabaseHas('tanks', $data);
    }

    // a user cannot create a tank
    public function test_a_user_cannot_create_a_tank(): void
    {
        $user = $this->newUser();

        $data = Tank::factory()->make()->toArray();

        $response = $this->actingAs($user)->post(route('tanks.store'), $data);

        $response->assertStatus(403);
    }

    // a user cannot see the tank edit page
    public function test_a_user_cannot_see_the_tank_edit_page(): void
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->get(route('tanks.edit', $tank->id));

        $response->assertStatus(403);
    }

    // an admin user can see the tank edit page
    public function test_an_admin_user_can_see_the_tank_edit_page(): void
    {
        $user = $this->newAdminUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->get(route('tanks.edit', $tank->id));

        $response->assertStatus(200);

        $response->assertViewIs('tanks.edit');
    }

    // an admin user can update a tank
    public function test_an_admin_user_can_update_a_tank(): void
    {
        $user = $this->newAdminUser();

        $tank = Tank::factory()->create();

        $data = Tank::factory()->make()->toArray();

        $response = $this->actingAs($user)->put(route('tanks.update', $tank->id), $data);

        $response->assertRedirect(route('tanks.show', $tank->id));

        $this->assertDatabaseHas('tanks', $data);
    }

    // a user cannot update a tank
    public function test_a_user_cannot_update_a_tank(): void
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $data = Tank::factory()->make()->toArray();

        $response = $this->actingAs($user)->put(route('tanks.update', $tank->id), $data);

        $response->assertStatus(403);
    }

    // a user cannot delete a tank
    public function test_a_user_cannot_delete_a_tank(): void
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->delete(route('tanks.destroy', $tank->id));

        $response->assertStatus(403);
    }

    // an admin user can delete a tank
    public function test_an_admin_user_can_delete_a_tank(): void
    {
        $user = $this->newAdminUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->delete(route('tanks.destroy', $tank->id));

        $response->assertRedirect(route('tanks.index'));
    }
}
