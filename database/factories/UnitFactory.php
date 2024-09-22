<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wialon_id' => $this->faker->uuid(),
            'wialon_nm' => $this->faker->randomLetter(3) . $this->faker->randomNumber(3) . $this->faker->randomLetter(2),
            'wialon_mileage_sensor_id' => 'io200',
            'wialon_mileage_sensor_calibration_factor' => 0.01,
            'wialon_fuel_consumption_sensor_id' => 'io201',
            'wialon_fuel_consumption_sensor_calibration_factor' => 0.001,
            'fuel_consumed_litres' => random_int(1000, mt_getrandmax()),
            'fuel_replenished_litres' => random_int(1000, mt_getrandmax()),
            'mileage_km' => random_int(1000, mt_getrandmax()),
            'mileage_replenished_km' => random_int(1000, mt_getrandmax()),
            'reset_at' => null,
            'reset_by' => null

        ];
    }
}
