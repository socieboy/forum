<?php

namespace Socieboy\Forum\Jobs\Replies;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Socieboy\Forum\Entities\Replies\Reply;
use Socieboy\Newsletter\Groups\GroupList as Group;
use Socieboy\Newsletter\Subscriber\SubscriberList as Subscriber;

class SubscribeUserToThread extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $list;

    protected $reply;
    /**
     * Create a new job instance.
     *
     * @param Reply $reply
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;

        $this->list = config('forum.emails.list');
    }

    /**
     * Execute the job.
     *
     * @param Subscriber $subscriber
     * @param Group $group
     * @return void
     */
    public function handle(Subscriber $subscriber, Group $group)
    {
        if( ! config('forum.emails.fire') ) return true;

        $subscriber->subscribe(
            $this->list,
            $this->reply->user->email,
            $this->setGroup($group)
        );
    }


    /**
     * @param $group
     * @return array
     */
    public function setGroup($group)
    {
        $subscriberGroups = $group->subscriberGroups(
            $this->list,                //  List name
            $this->reply->user->email   //  Subscriber email
        );

        $groupName = array_merge($subscriberGroups, [$this->reply->conversation->slug]);


        dd($groupName);

        return [
            'GROUPINGS' => [
                [
                    'name' => 'Forum',
                    'groups' => [$this->reply->conversation->slug]
                ]
            ]
        ];
    }
}
