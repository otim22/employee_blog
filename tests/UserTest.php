<?php

namespace Tests;

use App\Models\User;
use App\Models\Post;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_login()
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

    /** @test */
    public function user_can_delete_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
                ->post('/api/login');

        $post = Post::factory()->create(['title' => 'Initial title']);

        $this->delete('/api/posts/'.$post->id, [], $this->headers($user))
                ->seeStatusCode(204);

        $post = Post::find($post->id);

        $this->assertEmpty($post);
    }
}
