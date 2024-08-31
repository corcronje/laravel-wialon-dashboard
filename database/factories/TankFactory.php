<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tank>
 */
class TankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $volume = $this->faker->randomNumber(5);

        return [
            'name' => $this->faker->name,
            'volume_in_liters' => $volume,
            'current_volume_in_liters' => $volume * 0.75,
        ];
    }
}
