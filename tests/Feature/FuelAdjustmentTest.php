<?php

namespace Tests\Feature;

use App\Models\FuelAdjustment;
use App\Models\Tank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FuelAdjustmentTest extends TestCase
{
    // a user can view the fuel adjustments index page
    public function test_user_can_view_the_fuel_adjustments_index_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('adjustments.index'));

        $response->assertStatus(200);
    }

    // a user can view the fuel adjustments show page
    public function test_user_can_view_the_fuel_adjustments_show_page()
    {
        $user = $this->newUser();

        $adjustment = FuelAdjustment::factory()->create();

        $response = $this->actingAs($user)->get(route('adjustments.show', $adjustment));

        $response->assertStatus(200);
    }

    // a user cannot view the fuel adjustments create page
    public function test_user_cannot_view_the_fuel_adjustments_create_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('adjustments.create'));

        $response->assertStatus(403);
    }

    // a admin user can view the fuel adjustments create page
    public function test_admin_user_can_view_the_fuel_adjustments_create_page()
    {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->get(route('adjustments.create'));

        $response->assertStatus(200);
    }

    // a user cannot create a fuel adjustment
    public function test_user_cannot_create_a_fuel_adjustment()
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->post(route('adjustments.store'), [
            'reason' => 'Fuel adjustment test',
            'tank_id' => $tank->id,
            'volume_in_millilitres' => 1000
        ]);

        $response->assertStatus(403);
    }

    // a admin user can create a fuel adjustment
    public function test_admin_user_can_create_a_fuel_adjustment()
    {
        $user = $this->newAdminUser();

        $tank = Tank::factory()->create();

        $currentTankVolumeInMillilitres = $tank->current_volume_in_millilitres;

        $adjustmentLitres = rand(-100, 100);

        $response = $this->actingAs($user)->post(route('adjustments.store'), [
            'reason' => 'Fuel adjustment test',
            'tank_id' => $tank->id,
            'volume_in_litres' => $adjustmentLitres
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('adjustments.index'));

        $tank->refresh();

        $this->assertEquals($tank->current_volume_in_millilitres, $currentTankVolumeInMillilitres + ($adjustmentLitres * 1000));
    }
}
