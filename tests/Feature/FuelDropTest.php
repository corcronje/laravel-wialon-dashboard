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
}
