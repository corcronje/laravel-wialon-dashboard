<?php

namespace Tests\Feature;

use App\Models\FuelDrop;
use App\Models\Tank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FuelDropTest extends TestCase
{
    // a user can view the fuel drops index page
    public function test_user_can_view_the_fuel_drops_index_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('drops.index'));

        $response->assertStatus(200);
    }

    // a user can view the fuel drops show page
    public function test_user_can_view_the_fuel_drops_show_page()
    {
        $user = $this->newUser();

        $drop = FuelDrop::factory()->create();

        $response = $this->actingAs($user)->get(route('drops.show', $drop));

        $response->assertStatus(200);
    }

    // a user cannot view the fuel drops create page
    public function test_user_cannot_view_the_fuel_drops_create_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('drops.create'));

        $response->assertStatus(403);
    }

    // a admin user can view the fuel drops create page
    public function test_admin_user_can_view_the_fuel_drops_create_page()
    {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->get(route('drops.create'));

        $response->assertStatus(200);
    }

    // a user cannot view the fuel drops edit page
    public function test_user_cannot_view_the_fuel_drops_edit_page()
    {
        $user = $this->newUser();

        $drop = FuelDrop::factory()->create();

        $response = $this->actingAs($user)->get(route('drops.edit', $drop));

        $response->assertStatus(403);
    }

    // a admin user can view the fuel drops edit page
    public function test_admin_user_can_view_the_fuel_drops_edit_page()
    {
        $user = $this->newAdminUser();

        $drop = FuelDrop::factory()->create();

        $response = $this->actingAs($user)->get(route('drops.edit', $drop));

        $response->assertStatus(200);
    }

    // a user cannot delete a fuel drop
    public function test_user_cannot_delete_a_fuel_drop()
    {
        $user = $this->newUser();

        $drop = FuelDrop::factory()->create();

        $response = $this->actingAs($user)->delete(route('drops.destroy', $drop));

        $response->assertStatus(403);
    }

    // a admin user can delete a fuel drop
    public function test_admin_user_can_delete_a_fuel_drop()
    {
        $user = $this->newAdminUser();

        $drop = FuelDrop::factory()->create();

        $response = $this->actingAs($user)->delete(route('drops.destroy', $drop));

        $response->assertStatus(302);
    }

    // a user cannot create a fuel drop
    public function test_user_cannot_create_a_fuel_drop()
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->post(route('drops.store'), [
            'tank_id' => $tank->id,
            'volume_in_litres' => 1000
        ]);

        $response->assertStatus(403);
    }

    // a admin user can create a fuel drop
    public function test_admin_user_can_create_a_fuel_drop()
    {
        $user = $this->newAdminUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->post(route('drops.store'), [
            'tank_id' => $tank->id,
            'volume_in_litres' => 1000
        ]);

        $response->assertStatus(302);
    }

    // a user cannot update a fuel drop
    public function test_user_cannot_update_a_fuel_drop()
    {
        $user = $this->newUser();

        $drop = FuelDrop::factory()->create();

        $data = FuelDrop::factory()->make();

        $response = $this->actingAs($user)->put(route('drops.update', $drop), $data->toArray());

        $response->assertStatus(403);
    }

    // a admin user can update a fuel drop
    public function test_admin_user_can_update_a_fuel_drop()
    {
        $user = $this->newAdminUser();

        $drop = FuelDrop::factory()->create();

        $data = FuelDrop::factory()->make();

        $response = $this->actingAs($user)->put(route('drops.update', $drop), $data->toArray());

        $updated = FuelDrop::find($drop->id);

        $this->assertEquals($data->volume_in_litres, $updated->volume_in_litres);

        $response->assertStatus(302);
    }
}
