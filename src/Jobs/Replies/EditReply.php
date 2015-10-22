<?php
namespace Reflex\Forum\Jobs\Replies;

use Reflex\Forum\Jobs\Job;
use Illuminate\Support\Facades\Auth;
use Reflex\Forum\Entities\Replies\Reply;
use Illuminate\Contracts\Bus\SelfHandling;
use League\CommonMark\CommonMarkConverter;
use Reflex\Forum\Entities\Replies\ReplyRepo;

class EditReply extends Job implements SelfHandling
{
    /**
     * @var int
     */
    protected $reply_id;

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
     * @param int    $reply_id
     * @param string $message
     */
    public function __construct($reply_id, $message)
    {
        $this->reply_id = $reply_id;
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
    public function handle(ReplyRepo $replyRepo)
    {
        $reply = $replyRepo->findOrFail($this->reply_id);
        $reply->fill($this->prepareData());
        $reply->save();
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
            'reply_id'        => $this->reply_id,
            'message'         => $this->converter->convertToHtml($this->message),
        ];
    }
}
