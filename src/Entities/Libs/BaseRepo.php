<?php
namespace Reflex\Forum\Entities\Libs;

abstract class BaseRepo
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->model();
    }

    abstract public function model();

    public function find($id, array $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    public function findOrFail($id, array $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function lists($column, $key = null)
    {
        return $this->model->lists($column, $key);
    }

    public function all($columns = array('*'))
    {
        return $this->model->all($columns);
    }

    public function where($column, $operator = null, $value = null)
    {
        return $this->model->where($column, $operator, $value);
    }

    public function whereIn($colum, Array $array)
    {
        return $this->model->whereIn($colum, $array);
    }

    public function paginate($number = 10)
    {
        return $this->model->paginate($number);
    }

    public function orderBy($colum, $type = 'DESC')
    {
        return $this->model->orderBy($colum, $type);
    }

    public function groupBy($colum)
    {
        return $this->model->groupBy($colum);
    }

    public function latest()
    {
        return $this->model->latest();
    }

    public function take($num)
    {
        return $this->model->take($num);
    }

    public function onlyTrashed()
    {
        return $this->model->onlyTrashed();
    }

    public function withTrashed()
    {
        return $this->model->withTrashed();
    }

    public function shuffle()
    {
        return $this->model->shuffle();
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->get()->first();
    }
}
