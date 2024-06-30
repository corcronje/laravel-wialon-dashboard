<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripsTest extends TestCase
{
    // the index page can be seen by an authenticated user
    public function test_index_page_can_be_seen_by_authenticated_user(): void
    {
        $user = \App\Models\User::first();

        $response = $this->actingAs($user)->get('/trips');

        $response->assertStatus(200);
    }

    // a trip can be created by an authenticated user
    public function test_trip_can_be_created_by_authenticated_user(): void
    {
        $user = \App\Models\User::first();

        $driver = \App\Models\Driver::withoutPendingTrips()->get()->random();

        $unit = \App\Models\Unit::withoutPendingTrips()->get()->random();

        $response = $this->actingAs($user)->post('/trips', [
            'driver_id' => $driver->id,
            'unit_id' => $unit->id,
        ]);

        $response->assertStatus(302);
    }
}
