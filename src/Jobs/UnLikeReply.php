<?php

namespace Socieboy\Forum\Jobs;

use App\Jobs\Job;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;
use Socieboy\Forum\Entities\Likes\LikeRepo;

class UnLikeReply extends Job implements SelfHandling
{

    protected $reply_id;
    /**
     * Create a new job instance.
     * @param $reply_id
     */
    public function __construct($reply_id)
    {
        $this->reply_id = $reply_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(LikeRepo $likeRepo, Guard $auth)
    {
        $like = $likeRepo->where('user_id', $auth->user()->id)
                         ->where('reply_id', $this->reply_id)
                         ->first();

        $like->delete();

    }
}
