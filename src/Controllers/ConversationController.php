<?php
namespace Reflex\Forum\Controllers;

use Reflex\Forum\Jobs\StartConversationJob;
use Reflex\Forum\Requests\ConversationRequest;
use Reflex\Forum\Jobs\Conversations\StartConversation;
use Reflex\Forum\Entities\Conversations\ConversationRepo;
use Reflex\Forum\Jobs\Conversations\CreateConversationThread;

class ConversationController extends BaseController
{
    /**
     * @var ConversationRepo
     */
    protected $conversationRepo;

    /**
     * @param ConversationRepo $conversationRepo
     */
    function __construct(ConversationRepo $conversationRepo)
    {
        $this->conversationRepo = $conversationRepo;
    }

    /**
     * Display a conversation and replies
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $conversation = $this->conversationRepo->findBySlug($slug);
        $replies = $conversation->replies()->orderBy('created_at', 'DESC')->paginate(4);

        return view('Forum::Conversations.show', compact('conversation', 'replies'));
    }

    /**
     * Store the new conversation.
     *
     * @param ConversationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConversationRequest $request)
    {
        $this->dispatch(new StartConversation($request));

        return redirect()->route('forum');
    }
}
