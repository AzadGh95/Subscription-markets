<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Models\Statistic;

class SubscriptionController extends Controller
{
    /**
     * Display the last record of Subscription
     *
     * @param  int  $devappId
     * @return SubscriptionResource
     */
    public function show($devappId): SubscriptionResource
    {
        return new SubscriptionResource(
            Statistic::firstWhere(Statistic::APP_ID, $devappId)
        );
    }
}
