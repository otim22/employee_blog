<?php

namespace Tests;

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserLogin()
    {
        $user = User::factory()->make();

        $this->post('/api/login', [
                    'email' => $user->email,
                    'password' => 'secret'
                ])
                ->assertTrue(true);

        $this->get('/api/posts', $this->headers($user))
                ->assertTrue(true);
    }
}
