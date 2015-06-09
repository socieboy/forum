<?php

namespace Socieboy\Forum\Jobs;

use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;
use Socieboy\Forum\Entities\Replies\Reply;


class PostReplyJob
{

    /**
     * @var Reply
     */
    protected $reply;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var CommonMarkConverter
     */
    protected $converter;

    /**
     * @param Reply $reply
     * @param array $data
     */
    function __construct(Reply $reply, Array $data)
    {
        $this->reply = $reply;

        $this->data = $data;

        $this->converter = new CommonMarkConverter();
    }

    /**
     * Set the reply information and save it on database.
     */
    public function handle()
    {
        $this->reply->conversation_id = $this->data['conversation_id'];

        $this->reply->user_id = Auth::User()->id;

        $this->data['message'] = $this->converter->convertToHtml($this->data['message']);

        $this->reply->fill($this->data);

        $this->reply->save();
    }
} 