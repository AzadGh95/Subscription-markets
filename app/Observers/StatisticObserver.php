<?php

namespace App\Observers;

use App\Models\Statistic;

class StatisticObserver
{
    /**
     * Handle the Statistic "created" event.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return void
     */
    public function created(Statistic $statistic)
    {
        //TODO: اگر از حالت ریجکت به حالت اکسپت رفت به ادمین ایمیل بدهد.
        //if($statistic->status)
    }

    /**
     * Handle the Statistic "updated" event.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return void
     */
    public function updated(Statistic $statistic)
    {
        //
    }

    /**
     * Handle the Statistic "deleted" event.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return void
     */
    public function deleted(Statistic $statistic)
    {
        //
    }

    /**
     * Handle the Statistic "restored" event.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return void
     */
    public function restored(Statistic $statistic)
    {
        //
    }

    /**
     * Handle the Statistic "force deleted" event.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return void
     */
    public function forceDeleted(Statistic $statistic)
    {
        //
    }
}
