<?php

namespace Socieboy\Forum\Jobs\Conversations;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Socieboy\Forum\Entities\Conversations\Conversation;
use Socieboy\Newsletter\Groups\GroupList as Group;
use Socieboy\Newsletter\Subscriber\SubscriberList as Subscriber;

class CreateConversationThread extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var mixed
     */
    protected $list;

    /**
     * @var Conversation
     */
    protected $conversation;
    /**
     * Create a new job instance.
     *
     * @param Conversation $conversation
     */
    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;

        $this->list = config('forum.emails.list');

    }

    /**
     * Execute the job.
     *
     * @param Group $group
     * @param Subscriber $subscriber
     * @return void
     */
    public function handle(Group $group, Subscriber $subscriber)
    {
        if( ! config('forum.emails.fire') ) return true;

        $this->createThread($group);

        $subscriber->subscribe(
            $this->list,
            $this->conversation->user->email,
            $this->setGroup()
        );

    }

    /**
     * @param Group $group
     *
     * @return \associative_array
     */
    public function createThread(Group $group)
    {
        if(! $group->has($this->list, 'Forum'))
        {
            return $group->grouping($this->list, 'Forum', ['groups' => $this->conversation->slug]);
        }

        return $group->group($this->list, $this->conversation->slug);
    }

    /**
     * @return array
     */
    public function setGroup()
    {
        return [
            'GROUPINGS' => [
                [
                    'name' => 'Forum',
                    'groups' => [$this->conversation->slug]
                ]
            ]
        ];
    }
}
