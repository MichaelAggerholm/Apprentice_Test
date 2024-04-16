<?php

namespace App\Listeners;

use App\Events\GenreActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogGenreActivity
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
     * @param  GenreActivity  $event
     * @return void
     */
    public function handle(GenreActivity $event)
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        activity()->log($user->name.' '.$event->activityType.' genre: '.$event->genre->name);
    }
}
