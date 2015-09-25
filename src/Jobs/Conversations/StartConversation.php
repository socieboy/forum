<?php
namespace Reflex\Forum\Jobs\Conversations;

use Reflex\Forum\Jobs\Job;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Bus\SelfHandling;
use League\CommonMark\CommonMarkConverter;
use EasySlug\EasySlug\EasySlugFacade as Slug;
use Reflex\Forum\Entities\Auth\AuthRepositoryInterface;
use Reflex\Forum\Entities\Conversations\ConversationRepo;

class StartConversation extends Job implements SelfHandling
{
    /**
     * @var string
     */
    protected $topic_id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var CommonMarkConverter
     */
    protected $converter;

    /**
     * Create a new job instance.
     * @param string $topic_id
     * @param string $title
     * @param string $message
     */
    function __construct($topic_id, $title, $message)
    {
        $this->topic_id = $topic_id;
        $this->title = $title;
        $this->message = strip_tags($message);
        $this->converter = new CommonMarkConverter();
        
        parent::__construct();
    }

    /**
     * Execute the job.
     *
     * @param ConversationRepo $conversationRepo
     * @return void
     */
    public function handle(ConversationRepo $conversationRepo)
    {
        $conversation = $conversationRepo->model();
        $conversation->fill( $this->prepareDate() );
        $conversation->save();
    }

    /**
     * Prepare array to fill the conversation model.
     *
     * @return array
     */
    public function prepareDate()
    {
        $databasePrefix = (Config::get('forum.database.prefix') ? Config::get('forum.database.prefix') . '_' : '');

        return [
            'user_id' => $this->auth->getActiveUser()->id,
            'title' => $this->title,
            'topic_id' => $this->topic_id,
            'message' => $this->converter->convertToHtml($this->message),
            'slug' => Slug::generateUniqueSlug($this->title, $databasePrefix . 'conversations')
        ];
    }
}
