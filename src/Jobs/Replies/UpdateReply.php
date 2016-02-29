<?php
namespace Socieboy\Forum\Jobs\Replies;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Socieboy\Forum\Entities\Replies\ReplyRepo;

class UpdateReply extends Job implements SelfHandling
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param int    $id
     * @param string $message
     */
    public function __construct($id, $message)
    {
        $this->id      = $id;
        $this->message = strip_tags($message);
    }

    /**
     * Execute the job.
     *
     * @param ReplyRepo $replyRepo
     *
     * @return void
     */
    public function handle(ReplyRepo $replyRepo)
    {
        $reply = $replyRepo->find($this->id);
        $reply->update($this->prepareData());
    }

    /**
     * Prepare an array to fill the reply model.
     *
     * @return array
     */
    public function prepareData()
    {
        return [
            'message' => $this->message,
        ];
    }
}
