<?php
namespace Socieboy\Forum\Controllers;

use Socieboy\Forum\Entities\Likes\LikeManager;
use Socieboy\Forum\Entities\Likes\LikeRepo;
use Illuminate\Routing\Controller;
use Socieboy\Forum\Requests\LikeRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;

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
        $this->dispatchFrom('Socieboy\Forum\Jobs\LikeReply', $request);

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
        $this->dispatchFrom('Socieboy\Forum\Jobs\UnLikeReply', $request);

        return redirect()->route('forum.conversation.show', $slug);
    }
}
