<?php

namespace Socieboy\Forum\Entities\Conversations;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    /**
     * @var string
     */
    protected $table = 'conversations';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'message', 'topic_id', 'slug'];

    /**
     * Return the user owner of this conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('forum.user.model'));
    }

    /**
     * Return replies on this conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany('Socieboy\Forum\Entities\Replies\Reply')->latest();
    }

    /**
     * Return the topic name.
     *
     * @return mixed
     */
    public function getTopicAttribute()
    {
        return config('forum.topics.'.$this->topic_id)['name'];
    }

    /**
     * Return the topic icon.
     *
     * @return mixed
     */
    public function getTopicIconAttribute()
    {
        return config('forum.topics.'.$this->topic_id)['icon'];
    }

    /**
     * Return the topic color.
     *
     * @return mixed
     */
    public function getTopicColorAttribute()
    {
        return config('forum.topics.'.$this->topic_id)['color'];
    }

    /**
     * Return true if the conversation has a correct answer.
     *
     * @return bool
     */
    public function hasCorrectAnswer()
    {
        foreach($this->replies as $reply)
        {
            if($reply->isCorrect()) return true;
        }

        return false;
    }


    /**
     *
     * @return mixed
     */
    public function correctAnswer()
    {
        foreach($this->replies as $reply)
        {
            if($reply->isCorrect()) return $reply;
        }
    }
}