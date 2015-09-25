<?php
namespace Reflex\Forum\Controllers;

use Reflex\Forum\Entities\Likes\LikeManager;
use Reflex\Forum\Entities\Likes\LikeRepo;
use Reflex\Forum\Requests\LikeRequest;

class LikesController extends BaseController
{
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
        $this->dispatchFrom('Reflex\Forum\Jobs\LikeReply', $request);

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
        $this->dispatchFrom('Reflex\Forum\Jobs\UnLikeReply', $request);

        return redirect()->route('forum.conversation.show', $slug);
    }
}
