<?php

namespace Socieboy\Forum\Jobs;

use Socieboy\Forum\Entities\Replies\Reply;

class SetCorrectAnswerStatus {

    protected $reply;

    function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function handle()
    {
        $this->reply->correct_answer = !$this->reply->correct_answer;
        $this->reply->save();
    }


} 