<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    public function test_the_get_all_posts_returns_a_successful_response()
    {
        $response = $this->get('/posts');
        $response->assertSee('#')
            ->assertStatus(200);
    }
    public function test_the_post_has_title_returns_a_successful_response()
    {
        $post= Post::factory()->create();
        $this->assertNotEmpty($post->title, $post->body);
    }
    public function test_the_post_if_empty_returns_a_successful_response()
    {
        $response= $this->get('/posts');
        $response ->assertSee('no posts');
    }
}
