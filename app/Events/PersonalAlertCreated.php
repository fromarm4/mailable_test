<?php

namespace App\Events;

use App\Post;
use App\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PersonalAlertCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $post;
     public $triggered_user;
     public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $triggered_user, $data)
    {
        $this->post = $post;
        $this->triggered_user = $triggered_user;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
