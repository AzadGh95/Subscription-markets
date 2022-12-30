<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CheckSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a console command.
     *
     * @return void
     */
    public function test_command_subscription_active()
    {
        $bodyGoogleplay = file_get_contents(base_path('tests/Feature/Helper/googleplaydata_active.json'));
        $apiGoogleplay = Http::fake([
            'https//api.googleplay.co/*' => Http::response($bodyGoogleplay, 200),
        ]);

        $bodyAppleStore = file_get_contents(base_path('tests/Feature/Helper/googleplaydata_active.json'));
        $apiAppleStore = Http::fake([
            'https//api.applestore.co/*' => Http::response($bodyAppleStore, 200),
        ]);

        $this->artisan('check:subscriptions', [
            'applestore_api' => $apiAppleStore,
            'googplay_api' => $apiGoogleplay,
        ])->assertExitCode(0);
    }

    /**
     * Test a console command.
     *
     * @return void
     */
    public function test_command_subscription_expired()
    {
        $bodyGoogleplay = file_get_contents(base_path('tests/Feature/Helper/googleplaydata_expired.json'));
        $apiGoogleplay = Http::fake([
            'https//api.googleplay.co/*' => Http::response($bodyGoogleplay, 200),
        ]);

        $bodyAppleStore = file_get_contents(base_path('tests/Feature/Helper/googleplaydata_expired.json'));
        $apiAppleStore = Http::fake([
            'https//api.applestore.co/*' => Http::response($bodyAppleStore, 200),
        ]);

        $this->artisan('check:subscriptions', [
            'applestore_api' => $apiAppleStore,
            'googplay_api' => $apiGoogleplay,
        ])->assertExitCode(0);
    }

    /**
     * Test a console command.
     *
     * @return void
     */
    public function test_command_subscription_failed()
    {
        $bodyGoogleplay = file_get_contents(base_path('tests/Feature/Helper/googleplaydata_active.json'));
        $apiGoogleplay = Http::fake([
            'https//api.googleplay.co/*' => Http::response($bodyGoogleplay, 404),
        ]);

        $bodyAppleStore = file_get_contents(base_path('tests/Feature/Helper/googleplaydata_active.json'));
        $apiAppleStore = Http::fake([
            'https//api.applestore.co/*' => Http::response($bodyAppleStore, 404),
        ]);

        $this->artisan('check:subscriptions', [
            'applestore_api' => $apiAppleStore,
            'googplay_api' => $apiGoogleplay,
        ])->assertExitCode(0);
    }
}
