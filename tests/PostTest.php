<?php

use App\Models\Post;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    public function testCanCreatePost()
    {
        $data = [
            'title' => 'Test title',
            'body' => 'Content description thats in here.',
        ];

        $this->post('/api/posts', $data)
                ->seeStatusCode(201);
    }

    public function testCanGetPost()
    {
        $this->get("api/posts/2", []);
        $this->seeStatusCode(200);
    }
}
