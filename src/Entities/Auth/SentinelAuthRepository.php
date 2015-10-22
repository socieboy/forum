<?php namespace Reflex\Forum\Entities\Auth;

use Cartalyst\Sentinel\Sentinel;

class SentinelAuthRepository implements AuthRepositoryInterface
{
    protected $sentinel;

    public function __construct(Sentinel $sentinel)
    {
        $this->sentinel = $sentinel;
    }

    public function getActiveUser()
    {
        return $this->sentinel->getUser();
    }

    public function check()
    {
        return $this->sentinel->check();
    }

    public function can($permission)
    {
        return $this->sentinel->hasAccess($permission);
    }
}
