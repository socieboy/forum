<?php
namespace Socieboy\Forum\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

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
