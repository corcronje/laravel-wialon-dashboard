<?php

namespace Database\Factories;

use App\Models\Tank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pump>
 */
class PumpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tank = Tank::factory()->create();

        return [
            'name' => $this->faker->name,
            'guid' => $this->faker->uuid,
            'description' => $this->faker->sentence,
            'cents_per_millilitre' => random_int(10 * 1000, 100 * 1000),
            'pulses_per_millilitre' => random_int(100, 1000),
            'status' => 'active',
            'tank_id' => $tank->id,
        ];
    }
}
