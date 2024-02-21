<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrievePostsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    use RefreshDatabase;

    public function test_user_can_retrive_posts(){
        $this->actingAs($user = User::factory()->create(),'api');
        $posts = Post::factory(2)->create(['user_id'=>$user->id]);
 
        $response = $this->get('/api/posts');

        $response->assertStatus(200)->assertJson([
            'data'=>[
                [
                    'data'=>[
                        'type'=>'posts',
                        'post_id'=>$posts->last()->id,
                        'attributes'=>[
                            'body' => $posts->last()->body,
                        ],
                    ],    
                ],
                [
                    'data'=>[
                        'type'=>'posts',
                        'post_id'=>$posts->first()->id,
                        'attributes'=>[
                            'body' => $posts->first()->body,
                        ],
                    ], 
                ],
            ],
            'links' =>[
                'self' => url('/posts'),
            ],
        ]);
    }

    public function test_user_can_only_retrive_their_posts(){
        $this->actingAs($user = User::factory()->create(),'api');
        $posts = Post::factory(1)->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200)->assertExactJson([
            'data' =>[],
            'links' =>[
                'self' => url('/posts'),
            ],
        ]);
    }
}
