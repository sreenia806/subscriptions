<?php

namespace Tests\Unit;

use App\Plan;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function test_can_create_post() {

        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];

        $this->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function test_can_show_plan() {

        $this->get(route('posts.show', $post->id))
            ->assertStatus(200);
    }

    public function test_can_delete_post() {

        $post = factory(Post::class)->create();

        $this->delete(route('posts.delete', $post->id))
            ->assertStatus(204);
    }

    public function test_can_list_posts() {
        $posts = factory(Post::class, 2)->create()->map(function ($post) {
            return $post->only(['id', 'title', 'content']);
        });

        $this->get(route('posts'))
            ->assertStatus(200)
            ->assertJson($posts->toArray())
            ->assertJsonStructure([
                '*' => [ 'id', 'title', 'content' ],
            ]);
    }
}
