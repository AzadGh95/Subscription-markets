<?php

use App\Http\Controllers\Mock\AppleStoreSubscriptionController;
use App\Http\Controllers\Mock\GoogleplaySubscriptionController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::resource('subscription', SubscriptionController::class)
    ->only('show')->parameter('subscription', 'devapp_id');

Route::prefix('mock')
    ->as('mock.')
    ->group(function () {
        Route::resource('googleplay', GoogleplaySubscriptionController::class)
            ->only('show')
            ->parameter('googleplay', 'app_id');

        Route::resource('applestore', AppleStoreSubscriptionController::class)
            ->only('show')
            ->parameter('applestore', 'app_id');
    });
