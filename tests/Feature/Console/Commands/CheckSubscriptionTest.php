<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckSubscriptionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test a console command.
     *
     * @return void
     */
    public function test_console_command()
    {
        $this->artisan('check:subscriptions', [
            'applestore_api' => '',
            'googplay_api' => '',
        ])->assertExitCode(0);
    }
}
