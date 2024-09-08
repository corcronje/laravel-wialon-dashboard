<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unit = Unit::factory()->create();
        $driver = Driver::factory()->create();
        $user = User::factory()->create([
            'role_id' => Role::ADMIN,
        ]);

        return [
            'unit_id' => $unit->id,
            'driver_id' => $driver->id,
            'user_id' => $user->id,
            'fuel_consumed_litres' => $this->faker->randomNumber(2),
            'fuel_allowed_litres' => $this->faker->randomNumber(2),
            'fuel_replenished_litres' => $this->faker->randomNumber(2),
            'mileage_km' => $this->faker->randomNumber(2),
            'distance_travelled_km' => $this->faker->randomNumber(2),
            'status' => 'pending',
        ];
    }
}
