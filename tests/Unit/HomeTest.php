<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /** @test */
    public function get_home_index()
    {
        $response = $this->get( '/');

        $response->assertOk();
        $response->assertViewHasAll([
            'title', 'keywords', 'meta_desc', 'slider','portfolio', 'about', 'price'
        ]);
    }
}
