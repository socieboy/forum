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

    /**
     * Return all conversations of the topic given
     *
     * @param string $topic_id
     * @return mixed
     */
    public function topic($topic_id)
    {
        return $this->model->where('topic_id', $topic_id)->latest()->paginate(10);
    }

    /**
     * Search all conversations with the title like...
     *
     * @param array $data
     * @return mixed
     */
    public function search($data)
    {
        $title = $data['title'];

        return $this->model->where('title', 'LIKE', '%' . $title . '%')->latest()->paginate(10);
    }
}
