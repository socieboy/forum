<?php
namespace Reflex\Forum\Entities\Categories;

use Reflex\Forum\Entities\Libs\BaseRepo;

class CategoryRepo extends BaseRepo
{
    /**
     * @return Conversation
     */
    public function model()
    {
        return new Category;
    }
}
