<?php

namespace App\Enums;

enum SubscriptionStatusEnum: string
{
    case STATUS_PENDING = 'pending';
    case STATUS_ACCEPT = 'accept';
    case STATUS_REJECT = 'reject';
}
