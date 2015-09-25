<?php namespace Reflex\Forum\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class BaseController extends Controller
{
    use DispatchesCommands, ValidatesRequests, AuthorizesRequests;
}
