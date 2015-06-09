<?php

namespace Socieboy\Forum\Entities\Likes;

use Illuminate\Support\Facades\Auth;
use Socieboy\Forum\Entities\Libs\BaseManager;


class LikeManager extends BaseManager
{

    public function prepareData($data)
    {
        $data['user_id'] = Auth::User()->id;

        return $data;
    }
} 