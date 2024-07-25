<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create roles
        $roles = [
            ['name' => 'admin'],
            ['name' => 'user'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $users = [
            [
                'name' => 'Developer',
                'email' => 'developer@test',
                'password' => bcrypt('Developer@123'), // this is for testing purposes only
                'role_id' => 1
            ], [
                'name' => 'Morne',
                'email' => 'morne@sharetechnology.co.za',
                'password' => bcrypt('Morne@123'), // this is for testing purposes only
                'role_id' => 1
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // call the drivers seeder
        $this->call(DriverSeeder::class);
    }
}
