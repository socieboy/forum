<?php
namespace Socieboy\Forum\Jobs\Replies;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Socieboy\Forum\Entities\Replies\ReplyRepo;

class UpdateReply extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

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
     * @param request   $request
     */
    public function __construct($request)
    {
        $this->id      = $request->id;
        $this->message = strip_tags($request->message);
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
