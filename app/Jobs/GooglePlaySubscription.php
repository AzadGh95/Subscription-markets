<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\NotificationService;
use App\Services\SubscriptionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GooglePlaySubscription implements ShouldQueue
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
            $this->subscriptionService->InsertStatistic(
                $this->devappId,
                $subscriptionStatus['status']
            );
            //TODO: status from ‘active’ to ‘expired’ must be reported to admin via email

            $admin = User::find(1);
            (new NotificationService($this->devappId, $admin))->Email();
        }
    }
}
