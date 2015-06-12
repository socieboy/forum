<?php

namespace Socieboy\Forum\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;
use Socieboy\Forum\Entities\Replies\ReplyRepo;

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

        $this->message = $message;

        $this->converter = new CommonMarkConverter();
    }

    /**
     * Execute the job.
     *
     * @param ReplyRepo $replyRepo
     * @return void
     */
    public function handle(ReplyRepo $replyRepo)
    {
        $reply = $replyRepo->model();

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
            'user_id'   => Auth::User()->id,
            'conversation_id' => $this->conversation_id,
            'message'   => $this->converter->convertToHtml($this->message),
        ];
    }
}
