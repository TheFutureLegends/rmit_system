<?php

namespace App\Observers;

use App\Modules\Backend\Clubs\Models\Clubs;

class ClubObserver
{
    /**
     * Handle the clubs "created" event.
     *
     * @param  \App\Clubs  $clubs
     * @return void
     */
    public function created(Clubs $clubs)
    {
        //
    }

    /**
     * Handle the clubs "updated" event.
     *
     * @param  \App\Clubs  $clubs
     * @return void
     */
    public function updated(Clubs $clubs)
    {
        //
    }

    /**
     * Handle the clubs "deleted" event.
     *
     * @param  \App\Clubs  $clubs
     * @return void
     */
    public function deleted(Clubs $clubs)
    {
        $clubs->clearMediaCollection();
    }

    /**
     * Handle the clubs "restored" event.
     *
     * @param  \App\Clubs  $clubs
     * @return void
     */
    public function restored(Clubs $clubs)
    {
        //
    }

    /**
     * Handle the clubs "force deleted" event.
     *
     * @param  \App\Clubs  $clubs
     * @return void
     */
    public function forceDeleted(Clubs $clubs)
    {
        //
    }
}
