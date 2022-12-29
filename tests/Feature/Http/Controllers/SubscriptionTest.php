<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    private Statistic $statistic;

    public function setUp(): void
    {
        parent::setUp();

        $this->statistic = Statistic::factory()->create();
    }

    /**
     * A basic feature test api subscription_show.
     *
     * @return void
     */
    public function test_subscription_show()
    {
        $response = $this->get(route(
            'subscription.show',
            ['devapp_id' => $this->statistic->devapp_id]
        ));

        $response->assertStatus(200);
    }
}
