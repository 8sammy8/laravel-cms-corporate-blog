<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    /** @test */
    public function get_blog_index()
    {
        $response = $this->get(route('blogMain'));

        $response->assertOk();
        $response->assertViewHasAll([
            'title', 'keywords', 'meta_desc', 'post', 'price'
        ]);
    }

    /** @test */
    public function get_blog_cat()
    {
        $menu = Menu::select('id')->where('parent_id','!=',null)->first();

        $response = $this->call('get', 'blog', ['cat' => $menu->id]);

        $response->assertOk();
        $response->assertViewHasAll([
            'title', 'keywords', 'meta_desc', 'post', 'price'
        ]);
    }

    /** @test */
    public function get_blog_post()
    {
        $post = Post::select('id')->first();

        $response = $this->call('get', 'blog', ['cat' => $post->menu_id, 'post' => $post->id] );

        $response->assertOk();
        $response->assertViewHasAll([
            'title', 'keywords', 'meta_desc', 'post', 'price'
        ]);
    }
}
