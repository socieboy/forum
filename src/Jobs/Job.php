<?php namespace Reflex\Forum\Jobs;

use Reflex\Forum\Entities\Auth\AuthRepositoryInterface;

abstract class Job
{
	protected $auth;

	public function __construct(AuthRepositoryInterface $auth)
	{
		$this->auth = $auth;
	}

	
}