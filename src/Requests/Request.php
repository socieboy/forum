<?php namespace Reflex\Forum\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Reflex\Forum\Entities\Auth\AuthRepositoryInterface;

class Request extends FormRequest
{
    protected $auth;

    public function __construct(AuthRepositoryInterface $auth)
    {
        $this->auth = $auth;
    }
}
