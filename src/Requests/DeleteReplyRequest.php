<?php

namespace Socieboy\Forum\Requests;

use Illuminate\Auth\Guard;
use App\Http\Requests\Request;
use Socieboy\Forum\Entities\Replies\ReplyRepo;

class DeleteReplyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param ReplyRepo $replyRepo
     * @return bool
     */
    public function authorize(ReplyRepo $replyRepo)
    {
        $reply_id = $this->route('reply_id');

        $reply = $replyRepo->findOrFail($reply_id);

        return  $reply->user_id == auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $databasePrefix = (config('forum.database.prefix') ? config('forum.database.prefix') . '_' : '');

        return [
            'reply_id' => 'required|exists:'.$databasePrefix.'replies,id'
        ];
    }
}
