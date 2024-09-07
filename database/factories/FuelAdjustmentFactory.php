<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Tank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FuelAdjustment>
 */
class FuelAdjustmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tank = Tank::all()->random();
        $user = User::admins()->get()->random();

        if (!$tank) {
            $tank = Tank::factory()->create();
        }

        if (!$user) {
            $user = User::factory()->create([
                'role_id' => Role::ADMIN
            ]);
        }

        return [
            'volume_in_millilitres' => random_int(100 * 1000, 1000 * 1000),
            'tank_id' => $tank->id,
            'user_id' => $user->id
        ];
    }
}
