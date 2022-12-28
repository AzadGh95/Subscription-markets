<?php

namespace App\Services;

use App\Mail\SubscriptionMail;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    private $devappId;

    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($devappId, $user)
    {
        $this->devapp = $devappId;
        $this->user = $user;
    }

    public function Email()
    {
        Mail::to($this->user)->send(new SubscriptionMail($this->devappId));
    }
}
