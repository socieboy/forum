<?php
namespace Reflex\Forum\Jobs;

use Reflex\Forum\Entities\Likes\LikeRepo;
use Illuminate\Contracts\Bus\SelfHandling;
use Reflex\Forum\Entities\Auth\AuthRepositoryInterface;

class UnLikeReply extends Job implements SelfHandling
{
    /**
     * @var int
     */
    protected $reply_id;

    /**
     * Create a new job instance.
     *
     * @param int $reply_id
     */
    public function __construct($reply_id, AuthRepositoryInterface $auth)
    {
        $this->reply_id = $reply_id;

        parent::__construct($auth);
    }

    /**
     * Execute the job.
     *
     * @param LikeRepo $likeRepo
     * @param Guard $auth
     * @return void
     */
    public function handle(LikeRepo $likeRepo)
    {
        $like = $likeRepo->where('user_id', $this->auth->getActiveUser()->id)
            ->where('reply_id', $this->reply_id)
            ->first();

        $like->delete();
    }
}
