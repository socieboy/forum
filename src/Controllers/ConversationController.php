<?php

namespace Socieboy\Forum\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Socieboy\Forum\Jobs\Conversations\StartConversation;
use Socieboy\Forum\Jobs\Conversations\UpdateConversation;
use Socieboy\Forum\Jobs\StartConversationJob;
use Socieboy\Forum\Requests\ConversationRequest;
use Socieboy\Forum\Requests\UpdateReplyRequest;
use Socieboy\Forum\Entities\Conversations\ConversationRepo;
use Socieboy\Forum\Jobs\Conversations\CreateConversationThread;

class ConversationController extends Controller
{
    use DispatchesJobs;

    /**
     * @var ConversationRepo
     */
    protected $conversationRepo;

    /**
     * @param ConversationRepo $conversationRepo
     */
    function __construct(ConversationRepo $conversationRepo)
    {
        $this->middleware('auth', ['only' => ['store']]);
        $this->conversationRepo = $conversationRepo;
    }

    /**
     * Display a conversation and replies.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $conversation = $this->conversationRepo->findBySlug($slug);
        $replies      = $conversation->replies()->orderBy('created_at', 'asc')->paginate(4);

        return view('Forum::Conversations.show', compact('conversation', 'replies'));
    }

    /**
     * Store the new conversation.
     *
     * @param ConversationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConversationRequest $request)
    {
        $this->dispatch(new StartConversation($request));

        return redirect()->route('forum');
    }

    /**
     * Display the conversation edit form.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $conversation = $this->conversationRepo->findBySlug($slug);

        return view('Forum::Conversations.edit')->with(compact('conversation'));
    }

    /**
     * Update an existing conversation.
     *
     * @param UpdateReplyRequest $request
     * @param                    $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateReplyRequest $request, $slug)
    {
        $this->dispatch(new UpdateConversation($request));
        return redirect()->route('forum.conversation.show', $slug);
    }
}
