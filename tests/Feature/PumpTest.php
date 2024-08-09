<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PumpTest extends TestCase
{
    public function test_a_user_can_see_the_pump_index_page(): void
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('pumps.index'));

        $response->assertStatus(200);
    }

    public function test_a_user_can_see_the_pump_create_page(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('pumps.create'));

        $response->assertStatus(200);
    }

    public function test_a_user_can_create_a_pump(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->post(route('pumps.store'), [
            'name' => 'Test Pump',
            'description' => 'Test Pump Description',
            'price' => 1000,
            'quantity' => 10,
        ]);

        $response->assertRedirect(route('pumps.index'));
    }

    public function test_a_user_can_see_the_pump_edit_page(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('pumps.edit', 1));

        $response->assertStatus(200);
    }

    public function test_a_user_can_update_a_pump(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->put(route('pumps.update', 1), [
            'name' => 'Test Pump Updated',
            'description' => 'Test Pump Description Updated',
            'price' => 2000,
            'quantity' => 20,
        ]);

        $response->assertRedirect(route('pumps.index'));
    }

    public function test_a_user_can_delete_a_pump(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->delete(route('pumps.destroy', 1));

        $response->assertRedirect(route('pumps.index'));
    }

    private function newUser(): User
    {
        return User::factory()->create();
    }
}
