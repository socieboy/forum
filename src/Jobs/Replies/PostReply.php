<?php
namespace Reflex\Forum\Jobs\Replies;

use Reflex\Forum\Jobs\Job;
use Illuminate\Mail\Mailer;
use Reflex\Forum\Events\NewReply;
use Illuminate\Support\Facades\Auth;
use Reflex\Forum\Entities\Replies\Reply;
use Illuminate\Contracts\Bus\SelfHandling;
use League\CommonMark\CommonMarkConverter;
use Reflex\Forum\Entities\Replies\ReplyRepo;

class PostReply extends Job implements SelfHandling
{
    /**
     * @var int
     */
    protected $conversation_id;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var CommonMarkConverter
     */
    protected $converter;

    /**
     * Create a new job instance.
     *
     * @param int    $conversation_id
     * @param string $message
     */
    public function __construct($conversation_id, $message)
    {
        $this->conversation_id = $conversation_id;
        $this->message = strip_tags($message);
        $this->converter = new CommonMarkConverter();

        parent::__construct();
    }

    /**
     * Execute the job.
     *
     * @param ReplyRepo $replyRepo
     * @param Mailer    $mailer
     *
     * @return void
     */
    public function handle(ReplyRepo $replyRepo, Mailer $mailer)
    {
        $reply = $replyRepo->model();
        $reply->fill($this->prepareData());
        $reply->save();

        if (config('forum.emails.fire') && !$this->authUserIsOwner($reply->conversation)) {
            $this->sendEmail($mailer, $reply);
        }

        if (config('forum.broadcasting') && !$this->authUserIsOwner($reply->conversation)) {
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
            'user_id'         => $this->auth->getActiveUser()->id,
            'conversation_id' => $this->conversation_id,
            'message'         => $this->converter->convertToHtml($this->message),
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
                    $reply->user->{config('forum.user.username')})->subject(config('forum.emails.subject'));
            });
    }


    /**
     * Return true if the auth user is the owner of the conversation where the reply was left
     *
     * @param $conversation
     *
     * @return bool
     */
    protected function authUserIsOwner($conversation)
    {
        return $this->auth->getActiveUser()->id == $conversation->user_id;
    }

}
