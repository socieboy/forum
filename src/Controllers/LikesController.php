<?php
namespace Socieboy\Forum\Controllers;

use Illuminate\Routing\Controller;
use Socieboy\Forum\Jobs\LikeReply;
use Socieboy\Forum\Jobs\UnLikeReply;
use Socieboy\Forum\Requests\LikeRequest;
use Socieboy\Forum\Entities\Likes\LikeRepo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Socieboy\Forum\Entities\Likes\LikeManager;

class LikesController extends Controller
{

    use DispatchesJobs;
    /**
     * @var LikeRepo
     */
    protected $likeRepo;

    /**
     * @param LikeRepo $likeRepo
     */
    function __construct(LikeRepo $likeRepo)
    {
        $this->middleware('auth');
        $this->likeRepo = $likeRepo;
    }

    /**
     * User hit the like button.
     *
     * @param LikeRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function like(LikeRequest $request, $slug)
    {
        $this->dispatch(new LikeReply($request));

        return redirect()->route('forum.conversation.show', $slug);
    }

    /**
     * @param LikeRequest $request
     * @param string $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlike(LikeRequest $request, $slug)
    {
        $this->dispatch(new UnLikeReply($request));

        return redirect()->route('forum.conversation.show', $slug);
    }
}
