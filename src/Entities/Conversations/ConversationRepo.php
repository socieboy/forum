<?php

namespace Socieboy\Forum\Entities\Conversations;

use Socieboy\Forum\Entities\Libs\BaseRepo;

class ConversationRepo extends BaseRepo
{

    /**
     * @return Conversation
     */
    public function model()
    {
        return new Conversation;
    }
}