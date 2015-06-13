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
     * @var string
     */
    protected $grouping;

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

        $this->grouping = 'Forum';
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

        $this->createThread($group);

        $subscriber->subscribe(
            $this->list,
            $this->conversation->user->email,
            $this->setGroup()
        );

    }

    /**
     * @param Group $group
     */
    public function createThread(Group $group)
    {
        if(! $group->has($this->list, $this->grouping))
        {
            $group->grouping($this->list, $this->grouping, ['groups' => $this->conversation->slug]);
        }else{
            $group->group($this->list, $this->conversation->slug);
        }
    }

    /**
     * @return array
     */
    public function setGroup()
    {
        return [
            'GROUPINGS' => [
                [
                    'name' => $this->grouping,
                    'groups' => [$this->conversation->slug]
                ]
            ]
        ];
    }
}
