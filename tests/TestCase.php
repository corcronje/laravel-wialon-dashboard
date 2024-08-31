<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function newUser($data = []): User
    {
        return User::factory($data)->create();
    }

    public function newAdminUser()
    {
        return $this->newUser([
            'role_id' => Role::ADMIN,
        ]);
    }
}
