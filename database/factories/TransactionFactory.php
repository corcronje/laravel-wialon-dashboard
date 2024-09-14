<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Pump;
use App\Models\TransactionType;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->random();
        $driver = Driver::all()->random();
        $pump = Pump::all()->random();
        $unit = Unit::all()->random();
        $type = TransactionType::all()->random();

        if (!$user) {
            $user = User::factory()->create();
        }

        if (!$driver) {
            $driver = Driver::factory()->create();
        }

        if (!$pump) {
            $pump = Pump::factory()->create();
        }

        if (!$unit) {
            $unit = Unit::factory()->create();
        }

        if (!$type) {
            $type = TransactionType::factory()->create();
        }

        return [
            'user_id' => $user->id,
            'driver_id' => $driver->id,
            'pump_id' => $pump->id,
            'unit_id' => $unit->id,
            'transaction_type_id' => $type->id,
            'description' => $this->faker->sentence,
            'volume_in_millilitres' => random_int(100 * 1000, 1000 * 1000),
            'amount_in_cents' => random_int(1 * 1000, 10 * 1000),
        ];
    }
}
