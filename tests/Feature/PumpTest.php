<?php

namespace Tests\Feature;

use App\Models\Pump;
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

        $response->assertViewIs('pumps.index');
    }

    public function test_a_user_can_see_the_pump_create_page(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('pumps.create'));

        $response->assertStatus(200);

        $response->assertViewIs('pumps.create');
    }

    public function test_a_user_can_create_a_pump(): void {
        $user = $this->newUser();

        $data = Pump::factory()->make();

        $response = $this->actingAs($user)->post(route('pumps.store'), $data->toArray());

        $response->assertRedirect(route('pumps.index'));

        $this->assertDatabaseHas('pumps', $data->toArray());
    }

    public function test_a_user_can_see_the_pump_edit_page(): void {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('pumps.edit', 1));

        $response->assertStatus(200);

        $response->assertViewIs('pumps.edit');
    }

    public function test_a_user_can_update_a_pump(): void {
        $user = $this->newUser();
        $pump = Pump::factory()->create();
        $data = Pump::factory()->make();

        $response = $this->actingAs($user)->put(route('pumps.update', $pump->id), $data->toArray());

        $response->assertRedirect(route('pumps.index'));

        $this->assertDatabaseHas('pumps', $data->toArray());
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
