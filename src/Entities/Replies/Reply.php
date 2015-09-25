<?php
namespace Reflex\Forum\Entities\Replies;

use Illuminate\Support\Facades\Auth;
use Reflex\Forum\Entities\BaseModel;

class Reply extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'replies';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'conversation_id',
        'message'
    ];

    /**
     * Return the conversation parent of this reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo('Reflex\Forum\Entities\Conversations\Conversation');
    }

    /**
     * Return the user owner of this reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('forum.user.model'));
    }

    /**
     * Return all likes of this reply.
     *
     * @return mixed
     */
    public function likes()
    {
        return $this->hasMany('Reflex\Forum\Entities\Likes\Like');
    }

    /**
     * Return if the auth user has been hit the like button.
     *
     * @return bool
     */
    public function userLiked()
    {
        foreach ($this->likes as $like) {
            if ($like->user->id == $this->auth->getActiveUser()->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isCorrect()
    {
        return $this->correct_answer == 1;
    }
}
