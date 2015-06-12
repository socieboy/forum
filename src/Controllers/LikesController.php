<?php

namespace Socieboy\Forum\Controllers;

use Illuminate\Support\Facades\Auth;
use Socieboy\Forum\Entities\Likes\LikeManager;
use Socieboy\Forum\Entities\Likes\LikeRepo;
use App\Http\Controllers\Controller;
use Socieboy\Forum\Requests\LikeRequest;


class LikesController extends Controller
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
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function like(LikeRequest $request, $slug)
    {
        $this->dispatchFrom('Socieboy\Forum\Jobs\LikeReply', $request);

        return redirect()->route('forum.conversation.show', $slug);
    }

    /**
     * @param LikeRequest $request
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlike(LikeRequest $request, $slug)
    {

        $this->dispatchFrom('Socieboy\Forum\Jobs\UnLikeReply', $request);

        return redirect()->route('forum.conversation.show', $slug);
    }


} 