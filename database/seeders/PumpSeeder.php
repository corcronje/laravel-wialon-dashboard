<?php

namespace Database\Seeders;

use App\Models\Pump;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pump::factory()->count(10)->create();
    }
}
