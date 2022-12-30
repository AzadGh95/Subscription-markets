<?php

namespace App\Services;

use App\Models\Statistic;
use App\Models\User;

class StatisticService
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
                    foreach (User::active()->get() as $admin) {
                        (new NotificationService($this->devappId, $admin))->Email();
                    }
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
}
