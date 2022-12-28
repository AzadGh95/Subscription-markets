<?php

namespace App\Enums;

enum SubscriptionStatusEnum: string
{
    case PENDING = 'pending';
    case ACCEPT = 'accept';
    case REJECT = 'reject';
}
