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
        //$like = $this->likeRepo->model();

        //$manager = new LikeManager($like, $request->except('_token'));

        //$manager->save();

        return redirect()->route('forum.conversation.show', $slug);

    }


    public function unlike(LikeRequest $request, $slug)
    {
        $data = $request->only('reply_id');

        $like = $this->likeRepo->where('reply_id', $data['reply_id'])
                        ->where('user_id', Auth::User()->id)
        ->get()->first();

        $like->delete();

        return redirect()->route('forum.conversation.show', $slug);

    }


} 