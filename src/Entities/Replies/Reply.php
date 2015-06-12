<?php

namespace Socieboy\Forum\Entities\Replies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Reply extends Model
{

    /**
     * @var string
     */
    protected $table = 'replies';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'conversation_id', 'message'];

    /**
     * Return the conversation parent of this reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo('Socieboy\Forum\Entities\Conversations\Conversation');
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
        return $this->hasMany('Socieboy\Forum\Entities\Likes\Like');
    }

    /**
     * Return if the auth user has been hit the like button.
     *
     * @return bool
     */

    public function userLiked()
    {
        foreach($this->likes as $like)
        {
            if($like->user->id == Auth::User()->id)
            {
                return true;
            }
        }
        return false;
    }

    public function isCorrect()
    {
        return $this->correct_answer == 1;
    }

}