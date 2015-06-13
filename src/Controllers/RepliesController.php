<?php

namespace Socieboy\Forum\Controllers;

use App\Http\Controllers\Controller;
use Socieboy\Forum\Jobs\Replies\SubscribeUserToThread;
use Socieboy\Forum\Jobs\SetCorrectAnswerStatus;
use Socieboy\Forum\Requests\CorrectAnswerRequest;
use Socieboy\Forum\Requests\CreateReplyRequest;

class RepliesController extends Controller
{

    protected $replyRepo;


    /**
     * Implements the reply
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new conversation.
     *
     * @param CreateReplyRequest $request
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReplyRequest $request, $slug)
    {
        $reply = $this->dispatchFrom('Socieboy\Forum\Jobs\PostReply', $request);

        $this->dispatch(
            new SubscribeUserToThread($reply)
        );

        return redirect()->route('forum.conversation.show', $slug);
    }

    /**
     * Set the correct answer
     *
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