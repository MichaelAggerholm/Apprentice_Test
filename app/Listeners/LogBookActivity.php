<?php

namespace App\Listeners;

use App\Events\BookActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogBookActivity
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
     * @param  BookActivity  $event
     * @return void
     */
    public function handle(BookActivity $event)
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        activity()->log($user->name.' '.$event->activityType.' book: '.$event->book->title);
    }
}
