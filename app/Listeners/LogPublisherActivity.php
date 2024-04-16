<?php

namespace App\Listeners;

use App\Events\AuthorActivity;
use App\Events\PublisherActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPublisherActivity
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
     * @param  PublisherActivity  $event
     * @return void
     */
    public function handle(PublisherActivity $event)
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        activity()->log($user->name.' '.$event->activityType.' publisher: '.$event->publisher->name);
    }
}
