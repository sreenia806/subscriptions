<?php

namespace Tests\Unit;

use App\Plan;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function test_can_show_plan() {

        $this->get(route('plans.show', 'fr'))
            ->assertStatus(200);
    }


    public function test_can_list_posts() {

        $this->get(route('plans'))
            ->assertStatus(200)
            ->assertJson($posts->toArray())
            ->assertJsonStructure([
                '*' => [ 'code', 'name', 'monthly_cost', 'yearly_cost' ],
            ]);
    }

    /*
    public function test_can_preview_subscriptions() {

        $this->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
    */

}
