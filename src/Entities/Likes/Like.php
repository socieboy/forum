<?php
namespace Socieboy\Forum\Entities\Likes;

use Socieboy\Forum\Entities\BaseModel;

class Like extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'likes';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'reply_id'];

    /**
     * @return mixed
     */
    public function reply()
    {
        return $this->belongsTo('Socieboy\Forum\Entities\Replies\Reply');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(config('forum.user.model'));
    }
}
