<?php

namespace Tests\Feature;

use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

    // the index page can be seen by an authenticated user
    public function test_index_page_can_be_seen_by_authenticated_user(): void
    {
        $user = \App\Models\User::first();

        Driver::factory()->count(55)->create();

        $response = $this->actingAs($user)->get('/drivers');

        $response->assertStatus(200);
    }

    // a driver can be created by an authenticated user
    public function test_driver_can_be_created_by_authenticated_user(): void
    {
        $user = \App\Models\User::first();

        $response = $this->actingAs($user)->post('/drivers', [
            'name' => $this->faker->name,
            'employee_number' => $this->faker->randomNumber(8),
        ]);

        $response->assertStatus(302);
    }
}
