<?php

namespace Database\Seeders;

use App\Models\FuelDip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelDipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FuelDip::factory()->count(100)->create();
    }
}
