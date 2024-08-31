<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'developer@test',
            'password' => bcrypt('Developer@3210'),
            'role_id' => Role::ADMIN,
        ]);

        User::factory(10)->create();
    }
}
