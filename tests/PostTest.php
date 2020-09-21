<?php

namespace Tests;

use App\Models\User;
use App\Models\Post;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function un_authenticated_user_cannot_create_a_post()
    {
        $data = [
            'title' => 'Test title',
            'body' => 'Content description thats in here.',
        ];

        $this->post('/api/posts', $data)
                ->seeStatusCode(401);
    }

    /** @test */
    public function authenticated_user_can_create_a_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
                ->post('/api/login');

        $data = [
            'title' => 'Test title',
            'body' => 'Content description thats in here.',
        ];

        $this->post('/api/posts', $data)
                ->seeStatusCode(201);
    }

    /** @test */
    public function authenticated_user_can_get_posts()
    {
        $user = User::factory()->create();
        $post = new Post();

        $this->actingAs($user)
                ->post('/api/login');

        $posts_data = [
            [
                'title' => 'First title',
                'body' => 'First body',
            ],
            [
                'title' => 'Second title',
                'body' => 'Second body',
            ],
            [
                'title' => 'Third title',
                'body' => 'Third body',
            ]
        ];

        foreach($posts_data as $post_data)
            $post->factory()->create($post_data);
        $this->get('/api/posts', $this->headers($user))
                    ->assertTrue(true);
    }

    /** @test */
    public function authenticated_user_can_get_a_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
                ->post('/login');

        $this->get("api/posts/2", []);
        $this->seeStatusCode(200);
    }

    /** @test */
    public function authenticated_user_can_update_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
                ->post('/api/login');

        $post = Post::factory()->create(['title' => 'Initial title']);
        $updated_data = [
            'title' => 'Updated!',
            'body' => 'Body content'
        ];

        $this->put('/api/posts/'.$post->id, $updated_data, $this->headers($user))
                ->seeStatusCode(200);

        $post = Post::first();

        $this->assertEquals($updated_data['title'], $post->title);
    }
}
