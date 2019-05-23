<?php

namespace Tests\Unit;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeTest extends TestCase
{
    /**
     * @return string encrypt($email)
     * @test
     */
    public function check_subscribe()
    {
        $email = Factory::create()->email;
        $response = $this->postJson(route('subscribe.store'), [
            'email' => $email
        ]);
        $this->assertTrue($response->json('success'));

        return encrypt($email);
    }

    /**
     * @param $hash
     * @depends check_subscribe
     * @test
     */
    public function check_unsubscribe_show($hash)
    {
        $response = $this->get(route('unsubscribe', ['hash' => $hash]));

        $response->assertOk();
        $response->assertViewHasAll([
            'title', 'keywords', 'meta_desc', 'hash'
        ]);
    }

    /**
     * @param $hash
     * @depends check_subscribe
     * @depends check_unsubscribe_show
     * @test
     */
    public function check_subscribe_destroy($hash)
    {
        $response = $this->delete(route('subscribe.destroy', ['hash' => $hash]));
        $response->assertRedirect('/');
    }
}
