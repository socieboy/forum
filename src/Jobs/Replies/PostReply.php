<?php

namespace Socieboy\Forum\Jobs\Replies;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;
use Socieboy\Forum\Entities\Replies\Reply;
use Socieboy\Forum\Entities\Replies\ReplyRepo;
use Socieboy\Forum\Events\NewReply;

class PostReply extends Job implements SelfHandling
{

    /**
     * @var
     */
    protected $conversation_id;

    /**
     * @var
     */
    protected $message;

    /**
     * @var CommonMarkConverter
     */
    protected $converter;

    /**
     * Create a new job instance.
     *
     * @param $conversation_id
     * @param $message
     */
    public function __construct($conversation_id, $message)
    {
        $this->conversation_id = $conversation_id;

        $this->message = strip_tags($message);

        $this->converter = new CommonMarkConverter();
    }

    /**
     * Execute the job.
     *
     * @param ReplyRepo $replyRepo
     * @param Mailer $mailer
     * @return void
     */
    public function handle(ReplyRepo $replyRepo, Mailer $mailer)
    {
        $reply = $replyRepo->model();

        $reply->fill($this->prepareData());

        $reply->save();

        if(config('forum.emails.fire') && auth()->user()->id != $reply->user_id) {

            $this->sendEmail($mailer, $reply);
        }

        if(config('forum.broadcasting') && auth()->user()->id != $reply->user_id)
        {
            event(new NewReply($reply));
        }

    }

    /**
     * Prepare an array to fill the reply model.
     *
     * @return array
     */
    public function prepareData()
    {
        return [
            'user_id'   => auth()->User()->id,
            'conversation_id' => $this->conversation_id,
            'message'   => $this->converter->convertToHtml($this->message),
        ];
    }

    /**
     * Send an email to the conversation owner.
     *
     * @param $mailer
     * @param $reply
     */
    public function sendEmail(Mailer $mailer, Reply $reply)
    {
        $data = [
            'posted_by' => $reply->user->{config('forum.user.username')},
            'link'      => route('forum.conversation.show', $reply->conversation->slug)
        ];

        $mailer->queue('Forum::Emails.template', ['data' => $data], function ($message) use ($reply) {

            $message->from(config('forum.emails.from'), config('forum.emails.from-name'));

            $message->to($reply->user->email,
                $reply->user->{config('forum.user.username')})
                ->subject(config('forum.emails.subject'));

        });
    }

}
