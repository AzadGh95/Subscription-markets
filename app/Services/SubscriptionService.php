<?php

namespace App\Services;

use App\Jobs\AppleStoreSubscription;
use App\Jobs\GooglePlaySubscription;
use App\Models\Statistic;
use App\Models\User;
use GuzzleHttp\Client;

class SubscriptionService
{
    public function addStatistic($devappId, $status): void
    {
        $count = 0;
        $statistic = Statistic::firstWhere(Statistic::APP_ID, $devappId);
        if ($statistic->exists()) {
            $count = $statistic->first()->expired_count;
            if ($status == 'expired') {
                $count++;
                if ($statistic->first()->last_status == 'active') {
                    $admin = User::find(1);
                    (new NotificationService($this->devappId, $admin))->Email();
                }
            }
        }
        Statistic::updateOrInsert(
            [
                Statistic::APP_ID => $devappId,
            ],
            [
                Statistic::LAST_STATUS => $status,
                Statistic::EXPIRED_COUNT => $count,
            ]
        );
    }

    public function GuzzleApi(string $url, $devappId)
    {
        $client = new Client();
        $response = $client->request('GET', $url);

        return [
            'status' => $response->getStatusCode(), // "200"
            'body' => $response->getBody(),  // {"type":"User"...'
        ];
    }

    public function Check($url, $type/*appstore - googleplay*/, $devappId)
    {
        $result = $this->GuzzleApi($url, $devappId);
        if ($result['status'] == 200) {
            match ($type) {
                'googleplay' => GooglePlaySubscription::dispatch($url, $devappId)
                    ->delay(now()->addHour()),
                'appstore' => AppleStoreSubscription::dispatch($url, $devappId)
                    ->delay(now()->addHours(2)),
            };
        }
    }
}
