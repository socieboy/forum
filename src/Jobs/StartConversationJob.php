<?php

namespace Socieboy\Forum\Jobs;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Socieboy\Forum\Entities\Conversations\Conversation;
use League\CommonMark\CommonMarkConverter;


class StartConversationJob
{

    /**
     * @var Conversation
     */
    protected $conversation;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var CommonMarkConverter
     */
    protected $converter;

    /**
     * @param Conversation $conversation
     * @param array $data
     */
    function __construct(Conversation $conversation, Array $data)
    {
        $this->conversation = $conversation;

        $this->data = $data;

        $this->converter = new CommonMarkConverter();
    }

    /**
     * Set the values of the conversation and save it in database.
     */
    public function handle()
    {
        $this->conversation->user_id = Auth::User()->id;

        $this->data['message'] = $this->converter->convertToHtml($this->data['message']);

        $this->data['slug'] = $this->setSlug();

        $this->conversation->fill($this->data);

        $this->conversation->save();
    }


    /**
     * Create a slug.
     *
     * @return string
     */
    protected function setSlug()
    {
        $slug = Str::Slug($this->data['title']);

        $before_slug = Conversation::where('slug', $slug)->get()->count();

        if($before_slug > 0)
        {
            $slug = $slug.'-'.($before_slug + 1);
        }

        return $slug;
    }


} 