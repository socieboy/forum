<?php
namespace Socieboy\Forum\Events;

use App\Events\Event;
use Socieboy\Forum\Entities\Replies\Reply;

class BestAnswer extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Reply
     */
    public $reply;

    /**
     * Create a new event instance.
     *
     * @param Reply $reply
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        if (config('forum.events.broadcast') == true) {
            return ['socieboy-forum-channel-' . $this->reply->conversation->user->id];
        }
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        if (config('forum.events.broadcast') == true) {
            return [
                'user' => $this->reply->user->{config('forum.user.username')},
                'link' => route('forum.conversation.show', $this->reply->conversation->slug)
            ];
        }
    }
}
