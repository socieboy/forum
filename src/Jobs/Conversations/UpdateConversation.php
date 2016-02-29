<?php
namespace Socieboy\Forum\Jobs\Conversations;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Socieboy\Forum\Entities\Conversations\ConversationRepo;

class UpdateConversation extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var string
     */
    protected $title;
    /**
     * @var int
     */
    protected $slug;

    /**
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param int    $slug
     * @param string $message
     * @param string $title
     */
    public function __construct($request)
    {
        $this->slug    = $request->slug;
        $this->title   = strip_tags($request->title);
        $this->message = strip_tags($request->message);
    }

    /**
     * Execute the job.
     *
     * @param ConversationRepo $conversationRepo
     *
     * @return void
     */
    public function handle(ConversationRepo $conversationRepo)
    {
        $conversation = $conversationRepo->findBySlug($this->slug);
        $conversation->update($this->prepareData());
    }

    /**
     * Prepare an array to fill the reply model.
     *
     * @return array
     */
    public function prepareData()
    {
        $databasePrefix = (config('forum.database.prefix') ? config('forum.database.prefix') . '_' : '');

        return [
            'title'   => $this->title,
            'message' => $this->message,
        ];
    }
}
