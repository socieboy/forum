<?php

namespace Socieboy\Forum\Jobs\Conversations;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;
use EasySlug\EasySlug\EasySlugFacade as Slug;
use Socieboy\Forum\Entities\Conversations\ConversationRepo;

class StartConversation extends Job implements SelfHandling
{
    /**
     * @var
     */
    protected $topic_id;

    /**
     * @var
     */
    protected $title;

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
     * @param $topic_id
     * @param $title
     * @param $message
     */
    function __construct($topic_id, $title, $message)
    {
        $this->topic_id = $topic_id;

        $this->title = $title;

        $this->message = $message;

        $this->converter = new CommonMarkConverter();
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
        return [
            'user_id' => Auth::User()->id,
            'title' => $this->title,
            'topic_id' => $this->topic_id,
            'message' => $this->converter->convertToHtml($this->message),
            'slug' => Slug::generateUniqueSlug($this->title, 'conversations')
        ];
    }


}
