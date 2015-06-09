<?php

namespace Socieboy\Forum\Requests;

use App\Http\Requests\Request;
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
        if($this->route('conversation_user_id') == $auth->user()->id)
        {
            return true;
        }
		return false;
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
