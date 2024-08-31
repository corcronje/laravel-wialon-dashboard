<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\Tank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    // a user can view the transactions index page
    public function test_user_can_view_the_transactions_index_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('transactions.index'));

        $response->assertStatus(200);
    }

    // a user can view the transactions show page
    public function test_user_can_view_the_transactions_show_page()
    {
        $user = $this->newUser();

        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($user)->get(route('transactions.show', $transaction));

        $response->assertStatus(200);
    }

    // a user cannot view the transactions create page
    public function test_user_cannot_view_the_transactions_create_page()
    {
        $user = $this->newUser();

        $response = $this->actingAs($user)->get(route('transactions.create'));

        $response->assertStatus(403);
    }

    // a admin user can view the transactions create page
    public function test_admin_user_can_view_the_transactions_create_page()
    {
        $user = $this->newAdminUser();

        $response = $this->actingAs($user)->get(route('transactions.create'));

        $response->assertStatus(200);
    }

    // a user cannot view the transactions edit page
    public function test_user_cannot_view_the_transactions_edit_page()
    {
        $user = $this->newUser();

        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($user)->get(route('transactions.edit', $transaction));

        $response->assertStatus(403);
    }

    // a admin user can view the transactions edit page
    public function test_admin_user_can_view_the_transactions_edit_page()
    {
        $user = $this->newAdminUser();

        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($user)->get(route('transactions.edit', $transaction));

        $response->assertStatus(200);
    }

    // a user cannot delete a transaction
    public function test_user_cannot_delete_a_transaction()
    {
        $user = $this->newUser();

        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($user)->delete(route('transactions.destroy', $transaction));

        $response->assertStatus(403);
    }

    // a admin user can delete a transaction
    public function test_admin_user_can_delete_a_transaction()
    {
        $user = $this->newAdminUser();

        $transaction = Transaction::factory()->create();

        $response = $this->actingAs($user)->delete(route('transactions.destroy', $transaction));

        $response->assertStatus(302);
    }

    // a user cannot create a transaction
    public function test_user_cannot_create_a_transaction()
    {
        $user = $this->newUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->post(route('transactions.store'), [
            'tank_id' => $tank->id,
            'volume_in_litres' => 1000
        ]);

        $response->assertStatus(403);
    }

    // a admin user can create a transaction
    public function test_admin_user_can_create_a_transaction()
    {
        $user = $this->newAdminUser();

        $tank = Tank::factory()->create();

        $response = $this->actingAs($user)->post(route('transactions.store'), [
            'tank_id' => $tank->id,
            'volume_in_litres' => 1000
        ]);

        $response->assertStatus(302);
    }

    // a user cannot update a transaction
    public function test_user_cannot_update_a_transaction()
    {
        $user = $this->newUser();

        $transaction = Transaction::factory()->create();

        $data = Transaction::factory()->make();

        $response = $this->actingAs($user)->put(route('transactions.update', $transaction), $data->toArray());

        $response->assertStatus(403);
    }

    // a admin user can update a transaction
    public function test_admin_user_can_update_a_transaction()
    {
        $user = $this->newAdminUser();

        $transaction = Transaction::factory()->create();

        $data = Transaction::factory()->make();

        $response = $this->actingAs($user)->put(route('transactions.update', $transaction), $data->toArray());

        $updated = Transaction::find($transaction->id);

        $this->assertEquals($data->volume_in_litres, $updated->volume_in_litres);

        $response->assertStatus(302);
    }
}
