<?php

namespace Socieboy\Forum\Controllers;

use App\Http\Controllers\Controller;
use Socieboy\Forum\Entities\Replies\ReplyRepo;
use Socieboy\Forum\Jobs\SetCorrectAnswerStatus;
use Socieboy\Forum\Requests\CorrectAnswerRequest;
use Socieboy\Forum\Requests\CreateReplyRequest;

class RepliesController extends Controller
{

    protected $replyRepo;

    /**
     * @param ReplyRepo $replyRepo
     */
    function __construct(ReplyRepo $replyRepo)
    {
        $this->middleware('auth');

        $this->replyRepo = $replyRepo;
    }

    /**
     * Store a new conversation.
     *
     * @param CreateReplyRequest $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReplyRequest $request, $slug)
    {
        $this->dispatchFrom('Socieboy\Forum\Jobs\PostReply', $request);

        return redirect()->route('forum.conversation.show', $slug);
    }

    /**
     * @param CorrectAnswerRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function correctAnswer(CorrectAnswerRequest $request)
    {
        $this->dispatchFrom('Socieboy\Forum\Jobs\CheckCorrectAnswer', $request);

        return redirect()->back();
    }

}