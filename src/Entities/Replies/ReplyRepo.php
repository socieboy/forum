<?php
namespace Reflex\Forum\Entities\Replies;

use Reflex\Forum\Entities\Libs\BaseRepo;

class ReplyRepo extends BaseRepo
{
    /**
     * @return Reply
     */
    public function model()
    {
        return new Reply;
    }
}
