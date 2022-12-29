<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::resource('subscription', SubscriptionController::class)
    ->only('show')->parameter('subscription', 'devapp_id');
