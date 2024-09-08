<?php

namespace Tests;

use App\Models\Driver;
use App\Models\Pump;
use App\Models\Role;
use App\Models\Unit;
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

    public function newPump()
    {
        return Pump::factory()->create();
    }

    public function newUnit()
    {
        return Unit::factory()->create();
    }

    public function newDriver()
    {
        return Driver::factory()->create();
    }
}
