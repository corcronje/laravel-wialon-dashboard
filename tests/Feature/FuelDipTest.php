<?php

namespace Tests\Feature;

use App\Models\FuelDip;
use App\Models\Tank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FuelDipTest extends TestCase
{
    // a user can view the fuel dips index page
    public function test_user_can_view_the_fuel_dips_index_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('dips.index'));

        $response->assertStatus(200);
    }

    // a user can view the fuel dips show page
    public function test_user_can_view_the_fuel_dips_show_page()
    {
        $user = $this->newUser();

        $dip = FuelDip::factory()->create();

        $response = $this->actingAs($user)->get(route('dips.show', $dip));

        $response->assertStatus(200);
    }

    // a user cannot view the fuel dips create page
    public function test_user_cannot_view_the_fuel_dips_create_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('dips.create'));

        $response->assertStatus(403);
    }

    // a admin user can view the fuel dips create page
    public function test_admin_user_can_view_the_fuel_dips_create_page()
    {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->get(route('dips.create'));

        $response->assertStatus(200);
    }

    // a user cannot view the fuel dips edit page
    public function test_user_cannot_view_the_fuel_dips_edit_page()
    {
        $user = $this->newUser();

        $dip = FuelDip::factory()->create();

        $response = $this->actingAs($user)->get(route('dips.edit', $dip));

        $response->assertStatus(403);
    }

    // a admin user can view the fuel dips edit page
    public function test_admin_user_can_view_the_fuel_dips_edit_page()
    {
        $user = $this->newAdminUser();

        $dip = FuelDip::factory()->create();

        $response = $this->actingAs($user)->get(route('dips.edit', $dip));

        $response->assertStatus(200);
    }

    // a user cannot delete a fuel dip
    public function test_user_cannot_delete_a_fuel_dip()
    {
        $user = $this->newUser();

        $dip = FuelDip::factory()->create();

        $response = $this->actingAs($user)->delete(route('dips.destroy', $dip));

        $response->assertStatus(403);
    }

    // a admin user can delete a fuel dip
    public function test_admin_user_can_delete_a_fuel_dip()
    {
        $user = $this->newAdminUser();

        $dip = FuelDip::factory()->create();

        $response = $this->actingAs($user)->delete(route('dips.destroy', $dip));

        $response->assertStatus(302);
    }

    // a user cannot create a fuel dip
    public function test_user_cannot_create_a_fuel_dip()
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->post(route('dips.store'), [
            'tank_id' => $tank->id,
            'volume_in_litres' => 1000
        ]);

        $response->assertStatus(403);
    }

    // a admin user can create a fuel dip
    public function test_admin_user_can_create_a_fuel_dip()
    {
        $user = $this->newAdminUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->post(route('dips.store'), [
            'tank_id' => $tank->id,
            'volume_in_litres' => 1000
        ]);

        $response->assertStatus(302);
    }

    // a user cannot update a fuel dip
    public function test_user_cannot_update_a_fuel_dip()
    {
        $user = $this->newUser();

        $dip = FuelDip::factory()->create();

        $data = FuelDip::factory()->make();

        $response = $this->actingAs($user)->put(route('dips.update', $dip), $data->toArray());

        $response->assertStatus(403);
    }

    // a admin user can update a fuel dip
    public function test_admin_user_can_update_a_fuel_dip()
    {
        $user = $this->newAdminUser();

        $dip = FuelDip::factory()->create();

        $data = FuelDip::factory()->make();

        $response = $this->actingAs($user)->put(route('dips.update', $dip), $data->toArray());

        $updated = FuelDip::find($dip->id);

        $this->assertEquals($data->volume_in_litres, $updated->volume_in_litres);

        $response->assertStatus(302);
    }
}
