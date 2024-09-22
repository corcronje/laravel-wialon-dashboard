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
            'name' => 'Tank ' . $this->faker->unique()->randomNumber(3),
            'volume_in_millilitres' => $volume,
            'current_volume_in_millilitres' => 0,
        ];
    }
}
