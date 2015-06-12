<?php

namespace Socieboy\Forum\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Socieboy\Forum\Entities\Likes\LikeRepo;

class LikeReply extends Job implements SelfHandling
{
    use SerializesModels;

    /**
     * @var
     */
    protected $reply_id;

    /**
     * Create a new job instance.
     *
     * @param $reply_id
     */
    public function __construct($reply_id)
    {
        $this->reply_id = $reply_id;
    }

    /**
     * Execute the job.
     *
     * @param LikeRepo $likeRepo
     * @return void
     */
    public function handle(LikeRepo $likeRepo)
    {
        $like = $likeRepo->model();

        $like->fill($this->prepareData());

        $like->save();

    }

    /**
     * Prepare an array to fill the model like.
     *
     * @return array
     */
    public function prepareData()
    {
        return [
            'user_id' => Auth::User()->id,
            'reply_id' => $this->reply_id
        ];
    }
}
