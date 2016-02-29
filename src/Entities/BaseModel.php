<?php
namespace Socieboy\Forum\Entities;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Set table prefix if any
     */
    public function __construct()
    {
        $this->table = (Config::get('forum.database.prefix') ? Config::get('forum.database.prefix') . '_' : '') . $this->table;
    }
}
