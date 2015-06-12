<?php

namespace Socieboy\Forum\Entities\Replies;

use Socieboy\Forum\Entities\Libs\BaseRepo;


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