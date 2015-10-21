<?php
namespace Reflex\Forum\Entities\Conversations;

use Reflex\Forum\Entities\Libs\BaseRepo;

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
        return $this->model->join('categories', 'conversations.topic_id', '=', 'categories.id')
                ->where('categories.slug', $topic_id)
                ->select('conversations.*', 'categories.id', 'categories.slug')
                ->latest()->paginate(10);
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
