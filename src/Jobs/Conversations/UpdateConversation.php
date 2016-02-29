<?php
namespace Socieboy\Forum\Jobs\Conversations;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Socieboy\Forum\Entities\Conversations\ConversationRepo;

class UpdateConversation extends Job implements SelfHandling
{
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
    public function __construct($slug, $message, $title)
    {
        $this->slug    = $slug;
        $this->title   = strip_tags($title);
        $this->message = strip_tags($message);
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
