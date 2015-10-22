<?php namespace Reflex\Forum\Entities\Auth;

interface AuthRepositoryInterface
{
    public function getActiveUser();

    public function check();

    public function can($permission);
}
