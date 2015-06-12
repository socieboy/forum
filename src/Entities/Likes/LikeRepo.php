<?php

namespace Socieboy\Forum\Entities\Likes;

use Socieboy\Forum\Entities\Libs\BaseRepo;

class LikeRepo extends BaseRepo
{

    /**
     * @return Like
     */
    public function model()
    {
        return new Like;
    }


} 