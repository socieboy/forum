<?php
namespace Reflex\Forum\Entities\Likes;

use Reflex\Forum\Entities\Libs\BaseRepo;

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
