<?php
namespace Socieboy\Forum\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Socieboy\Forum\Entities\Likes\LikeRepo;

class LikeReply extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var int
     */
    protected $reply_id;

    /**
     * Create a new job instance.
     *
     * @param int $reply_id
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
            'user_id' =>auth()->user()->id,
            'reply_id' => $this->reply_id
        ];
    }
}
