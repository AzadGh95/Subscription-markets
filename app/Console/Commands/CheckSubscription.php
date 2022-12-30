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
    protected $signature = 'check:subscriptions';

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
            $api = match ($item->platform) {
                PlatformEnum::ANDROID->value => route('mock.googleplay.show', ['app_id' => $item->id]),
                PlatformEnum::IOS->value => route('mock.applestore.show', ['app_id' => $item->id]),
            };
            (new SubscriptionService())->Check($api, $item->platform, $item->id);
        }

        return Command::SUCCESS;
    }
}
