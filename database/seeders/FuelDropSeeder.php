<?php

namespace Database\Seeders;

use App\Models\FuelDrop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelDropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FuelDrop::factory()->count(100)->create();
    }
}
