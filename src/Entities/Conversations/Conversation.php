<?php
namespace Socieboy\Forum\Entities\Conversations;

use Socieboy\Forum\Entities\BaseModel;

class Conversation extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'conversations';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'topic_id',
        'slug'
    ];

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
     * Get owner name attribute
     * @return string
     */
    public function getOwnerNameAttribute()
    {
        return $this->user->{config('forum.user.username')};
    }

    /**
     * Return the topic name.
     *
     * @return string
     */
    public function getTopicAttribute()
    {
        return config('forum.topics.' . $this->topic_id)['name'];
    }

    /**
     * Return the topic icon.
     *
     * @return string
     */
    public function getTopicIconAttribute()
    {
        return config('forum.topics.' . $this->topic_id)['icon'];
    }

    /**
     * Return the topic color.
     *
     * @return string
     */
    public function getTopicColorAttribute()
    {
        return config('forum.topics.' . $this->topic_id)['color'];
    }

    /**
     * Return true if the conversation has a correct answer.
     *
     * @return bool
     */
    public function hasCorrectAnswer()
    {
        foreach ($this->replies as $reply) {
            if ($reply->isCorrect()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return correct answer
     * @return mixed
     */
    public function correctAnswer()
    {
        foreach ($this->replies as $reply) {
            if ($reply->isCorrect()) {
                return $reply;
            }
        }
    }
}
