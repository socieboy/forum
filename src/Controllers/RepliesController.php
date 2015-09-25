<?php
namespace Socieboy\Forum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Socieboy\Forum\Entities\Replies\ReplyRepo;
use Socieboy\Forum\Jobs\Replies\SubscribeUserToThread;
use Socieboy\Forum\Jobs\SetCorrectAnswerStatus;
use Socieboy\Forum\Requests\CorrectAnswerRequest;
use Socieboy\Forum\Requests\CreateReplyRequest;
use Socieboy\Forum\Requests\DeleteReplyRequest;

class RepliesController extends Controller
{
    /**
     * Implements the reply
     *
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
     * @param string             $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReplyRequest $request, $slug)
    {
        $this->dispatchFrom('Socieboy\Forum\Jobs\Replies\PostReply', $request);

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


    public function destroy(DeleteReplyRequest $request, $slug, $reply_id)
    {
        $reply = $this->replyRepo->findOrFail($reply_id);

        $reply->delete();

        return redirect()->route('forum.conversation.show', $slug);
    }

}
