<?php

namespace App\Listeners;

use App\Events\ConditionActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogConditionActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ConditionActivity  $event
     * @return void
     */
    public function handle(ConditionActivity $event)
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        activity()->log($user->name.' '.$event->activityType.' condition: '.$event->condition->name);
    }
}
