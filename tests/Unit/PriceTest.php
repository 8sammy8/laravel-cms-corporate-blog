<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Filter;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PriceTest extends TestCase
{
    /** @test */
    public function get_price_show()
    {
        $filter = Filter::select('id')->first();

        $response = $this->get(route('prices.show', ['id' => $filter->id]));

        $response->assertOk();
        $response->assertViewHasAll([
            'title', 'keywords', 'meta_desc', 'price', 'tariff'
        ]);
    }
}
