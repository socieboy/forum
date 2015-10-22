<?php
namespace Reflex\Forum\Controllers;

use Illuminate\Http\Request;
use Reflex\Forum\Requests\EditReplyRequest;
use Reflex\Forum\Entities\Replies\ReplyRepo;
use Reflex\Forum\Jobs\SetCorrectAnswerStatus;
use Reflex\Forum\Requests\CreateReplyRequest;
use Reflex\Forum\Requests\DeleteReplyRequest;
use Reflex\Forum\Requests\CorrectAnswerRequest;
use Reflex\Forum\Jobs\Replies\SubscribeUserToThread;

class RepliesController extends BaseController
{
    /**
     * Implements the reply
     *
     * @param ReplyRepo $replyRepo
     */
    public function __construct(ReplyRepo $replyRepo)
    {
        $this->replyRepo = $replyRepo;
    }

    /**
     * Store a new conversation.
     *
     * @param CreateReplyRequest $request
     * @param string             $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReplyRequest $request, $slug)
    {
        $this->dispatchFrom('Reflex\Forum\Jobs\Replies\PostReply', $request);

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
        $this->dispatchFrom('Reflex\Forum\Jobs\CheckCorrectAnswer', $request);

        return redirect()->back();
    }


    public function destroy(DeleteReplyRequest $request, $slug, $reply_id)
    {
        $reply = $this->replyRepo->findOrFail($reply_id);

        $reply->delete();

        return redirect()->route('forum.conversation.show', $slug);
    }

    public function edit(EditReplyRequest $request, $slug, $reply_id)
    {
        $reply = $this->replyRepo->findOrFail($reply_id);

        $this->dispatchFrom('Reflex\Forum\Jobs\Replies\EditReply', $request);

        return redirect()->route('forum.conversation.show', $slug);
    }
}
