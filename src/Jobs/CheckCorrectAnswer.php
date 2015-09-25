<?php
namespace Reflex\Forum\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Reflex\Forum\Entities\Replies\ReplyRepo;

class CheckCorrectAnswer extends Job implements SelfHandling
{
    use SerializesModels;

    /**
     * @var int
     */
    protected $reply_id;

    /**
     * @param int $reply_id
     */
    function __construct($reply_id)
    {
        $this->reply_id = $reply_id;
    }

    /**
     * @param ReplyRepo $replyRepo
     */
    public function handle(ReplyRepo $replyRepo)
    {
        $reply = $replyRepo->findOrFail($this->reply_id);
        $reply->correct_answer = !$reply->correct_answer;
        $reply->save();
    }
}
