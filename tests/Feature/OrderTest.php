<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    // a user can view the orders index page
    public function test_user_can_view_orders_index_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->getJson(route('orders.index'));

        $response->assertStatus(200);
    }

    // a admin can view the orders create page
    public function test_admin_can_view_orders_create_page()
    {
        $admin = $this->newAdminUser();

        $response = $this->actingAs($admin)->getJson(route('orders.create'));

        $response->assertStatus(200);
    }

    // an admin can create a new order
    public function test_admin_can_create_a_new_order()
    {
        $admin = $this->newAdminUser();

        $unit = $this->newUnit();

        $driver = $this->newDriver();

        $response = $this->actingAs($admin)->postJson(route('orders.store'), [
            'unit_id' => $unit->id,
            'driver_id' => $driver->id,
            'quantity' => 100,
            'total' => 1000,
        ]);

        $response->assertStatus(302);
    }

    // a user can view a single order
    public function test_user_can_view_a_single_order()
    {
        $user = $this->newUser();

        Order::factory()->create();

        $response = $this->actingAs($user)->getJson(route('orders.show', 1));

        $response->assertStatus(200);
    }

    // an admin can view a single order
    public function test_admin_can_view_a_single_order()
    {
        $admin = $this->newAdminUser();

        Order::factory()->create();

        $response = $this->actingAs($admin)->getJson(route('orders.show', 1));

        $response->assertStatus(200);
    }

    // a pump can view a list of orders from the api route at api.orders.index
    public function test_pump_can_retrieve_a_list_of_orders_from_the_api_route()
    {
        $pump = $this->newPump();

        $response = $this->getJson(route('api.orders.index') . '?pump=' . $pump->guid);

        $response->assertStatus(200);
    }

    // someone without permission cannot retrieve a list of orders from the api route at api.orders.index
    public function test_someone_without_permission_cannot_retrieve_a_list_of_orders_from_the_api_route()
    {
        $response = $this->getJson(route('api.orders.index'));

        $response->assertStatus(422);
    }
}
