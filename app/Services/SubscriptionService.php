<?php

namespace App\Services;

use App\Enums\PlatformEnum;
use App\Jobs\AppleStoreSubscription;
use App\Jobs\GooglePlaySubscription;
use GuzzleHttp\Client;

class SubscriptionService
{
    public function GuzzleApi(string $api)
    {
        $client = new Client();
        $response = $client->request('GET', $api);

        return [
            'status' => $response->getStatusCode(),
            // 'body' => (string) $response->getBody(),
            'body' => json_decode($response->getBody(), true),

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
