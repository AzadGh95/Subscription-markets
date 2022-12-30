<?php

namespace App\Console\Commands;

use App\Enums\PlatformEnum;
use App\Models\Devapp;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class CheckSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:subscriptions {googplay_api} {applestore_api}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscriptions activity';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $devapps = Devapp::all();
        foreach ($devapps as $item) {
            $api = match ($this->platform) {
                PlatformEnum::ANDROID => $this->argument('googplay_api'),
                PlatformEnum::IOS => $this->argument('applestore_api'),
            };
            (new SubscriptionService())->GuzzleApi($api, $item->id);
        }

        return Command::SUCCESS;
    }
}
