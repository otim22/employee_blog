<?php

namespace Tests;

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanCreatePost()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
                ->post('/login');

        $data = [
            'title' => 'Test title',
            'body' => 'Content description thats in here.',
        ];

        $this->post('/api/posts', $data)
                ->seeStatusCode(201);
    }

    public function testCanGetPost()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
                ->post('/login');

        $this->get("api/posts/2", []);
        $this->seeStatusCode(200);
    }
}
