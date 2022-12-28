<?php

namespace App\Services;

use App\Jobs\AppleStoreSubscription;
use App\Jobs\GooglePlaySubscription;
use App\Models\Statistic;
use GuzzleHttp\Client;

class SubscriptionService
{
    public function InsertStatistic($devappId, $status): void
    {
        $statistic = new Statistic();
        $statistic->devapp_id = $devappId;
        $statistic->status = $status;
        $statistic->save();
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
