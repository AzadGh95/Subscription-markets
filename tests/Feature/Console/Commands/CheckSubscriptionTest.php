<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test a console command.
     *
     * @return void
     */
    public function test_command_subscription()
    {
        $this->artisan('check:subscriptions')->assertExitCode(0);
    }
}
