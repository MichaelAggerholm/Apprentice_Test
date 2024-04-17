<?php

namespace App\Events;

use App\Models\Book;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookActivity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Book $book;
    public string $activityType;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Book $book, string $activityType)
    {
        $this->user = $user;
        $this->book = $book;
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
