<?php

namespace App\Services;

use App\Enums\PlatformEnum;
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

    public function GuzzleApi(string $api)
    {
        $client = new Client();
        $response = $client->request('GET', $api);

        return [
            'status' => $response->getStatusCode(),
            'body' => $response->getBody(),
        ];
    }

    public function Check($api, $platform, $devappId)
    {
        $result = $this->GuzzleApi($api);
        if ($result['status'] == 200) {
            match ($platform) {
                PlatformEnum::ANDROID->value => GooglePlaySubscription::dispatch($api, $devappId)
                    ->delay(now()->addHour()),

                PlatformEnum::IOS->value => AppleStoreSubscription::dispatch($api, $devappId)
                    ->delay(now()->addHours(2)),
            };
        }
    }
}
