<?php
namespace Socieboy\Forum\Controllers;

use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    /**
     * Initialize profile controller.
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display forum profile user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $userModel = config('forum.user.model');
        $user = $userModel::find($id);

        return view('Forum::User.profile', compact('user'));
    }
}
