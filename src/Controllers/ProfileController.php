<?php

namespace Socieboy\Forum\Controllers;

use App\Http\Controllers\Controller;

class ProfileController extends Controller{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $userModel = config('forum.user.model');

        $user = $userModel::find($id);

        return view('Forum::User.profile', compact('user'));
    }

} 