<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllList()
    {
        return $this->model->all();
    }

    public function getListById($id)
    {
        return $this->model->findOrFail($id);
    }
}
