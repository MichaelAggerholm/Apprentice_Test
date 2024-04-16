<?php

namespace App\Events;

use App\Models\Language;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LanguageActivity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Language $language;
    public string $activityType;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Language $language, string $activityType)
    {
        $this->user = $user;
        $this->language = $language;
        $this->activityType = $activityType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
