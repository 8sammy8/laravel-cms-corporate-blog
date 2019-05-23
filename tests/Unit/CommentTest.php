<?php

namespace Tests\Unit;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function check_comment_store()
    {
        $user = User::select(['name', 'email'])->first();
        $post = Post::select('id')->first();

        $response = $this->postJson(route('comment.store'), [
            'comment_post_ID' => $post->id,
            'comment' => Factory::create()->paragraph(3),
            'comment_parent' => '',
            'name' => $user->name,
            'email' => $user->email
        ]);

        $this->assertTrue($response->json('success'));
    }
}
