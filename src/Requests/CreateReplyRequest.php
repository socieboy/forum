<?php
namespace Reflex\Forum\Requests;

use Illuminate\Support\Facades\Config;

class CreateReplyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'conversation_id' => 'required|exists:'.$databasePrefix.'conversations,id',
            'message' => 'required'
        ];
    }
}
