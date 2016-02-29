<?php

namespace Socieboy\Forum\Requests;

use Illuminate\Auth\Guard;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Config;
use Socieboy\Forum\Entities\Replies\ReplyRepo;

class DeleteReplyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Guard $auth
     * @param ReplyRepo $replyRepo
     * @return bool
     */
    public function authorize(Guard $auth, ReplyRepo $replyRepo)
    {
        $reply_id = $this->route('reply_id');

        $reply = $replyRepo->findOrFail($reply_id);

        return  $reply->user_id == $auth->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $databasePrefix = (Config::get('forum.database.prefix') ? Config::get('forum.database.prefix') . '_' : '');

        return [
            'reply_id' => 'required|exists:'.$databasePrefix.'replies,id'
        ];
    }
}
