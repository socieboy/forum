<?php namespace Reflex\Forum\Entities\Auth;

use Auth;

class LaravelAuthRepository implements AuthRepositoryInterface
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function getActiveUser()
    {
        return $this->auth->user();
    }

    public function check()
    {
        return $this->auth->check();
    }

    public function can($permission)
    {
        return $this->auth->user->can($permission);
    }
}
