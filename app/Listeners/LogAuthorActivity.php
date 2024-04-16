<?php

namespace App\Listeners;

use App\Events\AuthorActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogAuthorActivity
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
     * @param  AuthorActivity  $event
     * @return void
     */
    public function handle(AuthorActivity $event)
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        activity()->log($user->name.' '.$event->activityType.' author: '.$event->author->author_name);
    }
}
