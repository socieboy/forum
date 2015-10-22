<?php
namespace Reflex\Forum\Entities\Categories;

use Reflex\Forum\Entities\BaseModel;

class Category extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'color',
        'slug'
    ];
}
