<?php
namespace Reflex\Forum\Controllers;

class ProfileController extends BaseController
{
    /**
     * Initialize profile controller.
     */
    function __construct()
    {
        
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
