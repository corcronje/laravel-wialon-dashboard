<?php

namespace Database\Factories;

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
        return [
            'name' => $this->faker->name,
            'guid' => $this->faker->uuid,
            'description' => $this->faker->sentence,
            'cents_per_litre' => $this->faker->numberBetween(100, 2000),
            'volume_litres' => $this->faker->numberBetween(1000, 10000),
            'pulses_per_litre' => $this->faker->numberBetween(10, 100),
            'status' => 'active',
        ];
    }
}
