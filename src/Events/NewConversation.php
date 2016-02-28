<?php
namespace Socieboy\Forum\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Socieboy\Forum\Entities\Conversations\Conversation;

class NewConversation extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \Socieboy\Forum\Entities\Conversations\Conversation
     */
    public $conversation;

    /**
     * Create a new event instance.
     *
     * @param \Socieboy\Forum\Entities\Conversations\Conversation $conversation
     */
    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['socieboy-forum-channel-' . $this->conversation->user->id];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user' => $this->conversation->user->{config('forum.user.username')},
            'link' => route('forum.conversation.show', $this->conversation->slug)
        ];
    }
}
