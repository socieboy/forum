<?php namespace Reflex\Forum\Jobs;

use App;

abstract class Job
{
    protected $auth;

    public function __construct()
    {
        $this->auth = App::make(config('forum.auth-repo'));
    }
}
