<?php
namespace Reflex\Forum\Entities;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class BaseModel extends Model
{
    protected $auth;

    /**
     * Set table prefix if any
     */
    public function __construct()
    {
        $this->table = (Config::get('forum.database.prefix') ? Config::get('forum.database.prefix') . '_' : '') . $this->table;
        $this->auth = App::make(config('forum.auth-repo'));
    }
}
