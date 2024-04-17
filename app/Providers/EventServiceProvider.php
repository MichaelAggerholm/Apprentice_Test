<?php

namespace App\Providers;

use App\Events\AuthorActivity;
use App\Events\BookActivity;
use App\Events\ConditionActivity;
use App\Events\FormatActivity;
use App\Events\GenreActivity;
use App\Events\LanguageActivity;
use App\Events\PublisherActivity;
use App\Listeners\LogAuthorActivity;
use App\Listeners\LogBookActivity;
use App\Listeners\LogConditionActivity;
use App\Listeners\LogFormatActivity;
use App\Listeners\LogGenreActivity;
use App\Listeners\LogLanguageActivity;
use App\Listeners\LogPublisherActivity;
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
        AuthorActivity::class => [
            LogAuthorActivity::class,
        ],
        PublisherActivity::class => [
            LogPublisherActivity::class,
        ],
        ConditionActivity::class => [
            LogConditionActivity::class,
        ],
        BookActivity::class => [
            LogBookActivity::class,
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
