<?php
namespace Socieboy\Forum\Jobs\Replies;

use App\Jobs\Job;
use Illuminate\Mail\Mailer;
use Socieboy\Forum\Events\NewReply;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Socieboy\Forum\Entities\Replies\Reply;
use Illuminate\Contracts\Queue\ShouldQueue;
use Socieboy\Forum\Entities\Replies\ReplyRepo;

class PostReply extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var int
     */
    protected $conversation_id;

    /**
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->conversation_id = $request->conversation_id;
        $this->message = strip_tags($request->message);
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

        if (config('forum.events.fire')) {
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
            'user_id'         => auth()->user()->id,
            'conversation_id' => $this->conversation_id,
            'message'         => $this->message,
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

                $message->to($reply->conversation->user->email,
                    $reply->conversation->user->{config('forum.user.username')})->subject(config('forum.emails.subject'));
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
        return auth()->user()->id == $conversation->user_id;
    }

}
