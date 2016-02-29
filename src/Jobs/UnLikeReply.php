<?php
namespace Socieboy\Forum\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Socieboy\Forum\Entities\Likes\LikeRepo;

class UnLikeReply extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var int
     */
    protected $reply_id;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->reply_id = $request->reply_id;
    }

    /**
     * Execute the job.
     *
     * @param LikeRepo $likeRepo
     * @return void
     */
    public function handle(LikeRepo $likeRepo)
    {
        $like = $likeRepo->where('user_id', auth()->user()->id)
            ->where('reply_id', $this->reply_id)
            ->first();

        $like->delete();
    }
}
