<?php

namespace Database\Seeders;

use App\Models\Tank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tank::factory()->count(5)->create();
    }
}
