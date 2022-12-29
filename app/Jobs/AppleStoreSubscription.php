<?php

namespace App\Jobs;

use App\Services\SubscriptionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AppleStoreSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;

    private $devappId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected SubscriptionService $subscriptionService,
        $url,
        $devappId
    ) {
        $this->url = $url;
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
            ->GuzzleApi($this->url, $this->devappId);
        if ($result['status'] == 200) {
            $subscriptionStatus = $result['body'];
            $this->subscriptionService->addStatistic(
                $this->devappId,
                $subscriptionStatus['subscription']
            );
        }
    }
}
