<?php namespace Reflex\Forum\Entities\Auth;

interface AuthRepositoryInterface
{
    public function getActiveUser();

    public function check();
}