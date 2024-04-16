<?php

namespace App\Listeners;

use App\Events\FormatActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFormatActivity
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
     * @param  FormatActivity  $event
     * @return void
     */
    public function handle(FormatActivity $event)
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        activity()->log($user->name.' '.$event->activityType.' format: '.$event->format->name);
    }
}
