<?php

namespace App\Listeners;

use App\Events\LanguageActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogLanguageActivity
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
     * @param  LanguageActivity  $event
     * @return void
     */
    public function handle(LanguageActivity $event)
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        activity()->log($user->name.' '.$event->activityType.' language: '.$event->language->name);
    }
}
