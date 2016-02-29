<?php
namespace Socieboy\Forum\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Socieboy\Forum\Entities\Conversations\ConversationRepo;

class ForumController extends Controller
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
     * Display the main page of the forum.
     * All conversations are listed.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $conversations = $this->conversationRepo->latest()->paginate(10);

        return view('Forum::index', compact('conversations'));
    }

    /**
     * Display the main page of the forum.
     * All conversations are listed.
     *
     * @param string $topic_id
     * @return \Illuminate\View\View
     */
    public function topic($topic_id)
    {
        $conversations = $this->conversationRepo->topic($topic_id);

        return view('Forum::index', compact('conversations'));
    }


    /**
     * Search
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $conversations = $this->conversationRepo->search($request->all());

        return view('Forum::index', compact('conversations'));
    }
}
