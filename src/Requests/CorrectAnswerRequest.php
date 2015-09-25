<?php
namespace Reflex\Forum\Requests;

use Illuminate\Contracts\Auth\Guard;

class CorrectAnswerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Guard $auth
     * @return bool
     */
    public function authorize(Guard $auth)
    {
        return $this->route('conversation_user_id') == $this->auth->getActiveUser()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reply_id' => 'required'
        ];
    }
}
