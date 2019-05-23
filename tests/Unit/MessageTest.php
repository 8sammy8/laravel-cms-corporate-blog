<?php

namespace Tests\Unit;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MessageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function check_message_store()
    {
        $faker = Factory::create();
        $response = $this->postJson(route('message.store'), [
            'comment' => $faker->paragraph(1),
            'name' => $faker->name,
            'email' => $faker->email
        ]);

        $this->assertTrue($response->json('success'));
    }
}
