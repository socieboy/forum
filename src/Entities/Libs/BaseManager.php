<?php

namespace Socieboy\Forum\Entities\Libs;

abstract class BaseManager
{

    /**
     * @var
     */
    protected $entity;
    /**
     * @var
     */
    protected $data;

    /**
     * @param $entity
     * @param $data
     */
    public function __construct($entity, $data)
	{
		$this->entity   = $entity;
		$this->data     = $data;
	}

    /**
     * Prepare data before fill the model.
     *
     * @param $data
     * @return mixed
     */
    public function prepareData($data)
	{
		return $data;
	}

    /**
     * Save entity
     *
     * @return bool
     */
    public function save()
	{
        $this->entity->fill($this->prepareData($this->data));
        $this->entity->save();
		return true;
	}
}