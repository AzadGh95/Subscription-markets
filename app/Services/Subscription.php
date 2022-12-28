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
}
