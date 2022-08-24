<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }


    public function delete($id)
    {
        return $this->model->delete($id);
    }

    
    public function update($id, $attributes = [])
    {
        $object = $this->find($id);
        if ($object) {
            $object->update($attributes);
            return $object;
        }
        return false;
    }


    public function edit($id, $attributes = [])
    {
        $object = $this->find($id);
        if ($object) {
            $object->edit($attributes);
            return $object;
        }
        return false;
    }


    public function find($id)
    {
        return $this->model->find($id);
    }


    public function all()
    {
        return $this->model->all();
    }


    public function orderBy($field, $direction = 'desc') {
        return $this->model->orderBy($field, $direction);
    }
    

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null){
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }


    public function where($column, $operator = null, $value = null, $boolean = 'and') {
        return $this->model->where($column, $operator, $value, $boolean);
    }


    public function orWhere($column, $operator = null, $value = null) {
        return $this->orWhere($column, $operator, $value);
    }

    
}
