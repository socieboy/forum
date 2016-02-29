<?php
namespace Socieboy\Forum\Requests;

use App\Http\Requests\Request;

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
        $databasePrefix = (config('forum.database.prefix') ? config('forum.database.prefix') . '_' : '');

        return [
            'conversation_id' => 'required|exists:'.$databasePrefix.'conversations,id',
            'message' => 'required'
        ];
    }
}
