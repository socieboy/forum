<?php
namespace Reflex\Forum\Jobs;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Reflex\Forum\Entities\Likes\LikeRepo;
use Illuminate\Contracts\Bus\SelfHandling;
use Reflex\Forum\Entities\Auth\AuthRepositoryInterface;

class LikeReply extends Job implements SelfHandling
{
    use SerializesModels;

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
            'user_id' => $this->auth->getActiveUser()->id,
            'reply_id' => $this->reply_id
        ];
    }
}
