<?php

namespace App\Providers;

use App\Events\FormatActivity;
use App\Events\GenreActivity;
use App\Events\LanguageActivity;
use App\Listeners\LogFormatActivity;
use App\Listeners\LogGenreActivity;
use App\Listeners\LogLanguageActivity;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfullLogin',
        ],
        FormatActivity::class => [
            LogFormatActivity::class,
        ],
        GenreActivity::class => [
            LogGenreActivity::class,
        ],
        LanguageActivity::class => [
            LogLanguageActivity::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}