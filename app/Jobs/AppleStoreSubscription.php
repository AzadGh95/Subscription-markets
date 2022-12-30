<?php

namespace App\Jobs;

use App\Services\StatisticService;
use App\Services\SubscriptionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AppleStoreSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $api;

    private $devappId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected SubscriptionService $subscriptionService,
        protected StatisticService $statisticService,
        $api,
        $devappId
    ) {
        $this->api = $api;
        $this->devappId = $devappId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = $this->subscriptionService
            ->GuzzleApi($this->api);
        if ($result['status'] == 200) {
            $subscriptionStatus = $result['body'];
            $this->statisticService->addStatistic(
                $this->devappId,
                $subscriptionStatus['subscription']
            );
        }
    }
}
