<?php

namespace App\Services;

use App\Models\Statistic;

class Subscription
{
    public function Check()
    {
        // code...
    }

    public function InsertStatistic($devappId, $status): void
    {
        $statistic = new Statistic();
        $statistic->devapp_id = $devappId;
        $statistic->status = $status;
        $statistic->save();
    }

    public function Guzzle(string $url)
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/user', [
            'auth' => ['user', 'pass']
        ]);
        echo $res->getStatusCode();
        // "200"
        echo $res->getHeader('content-type')[0];
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // {"type":"User"...'
    }
}
