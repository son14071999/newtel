<?php
namespace App\Repositories;


interface BaseRepositoryInterface{
    public function create($attributes = []);
    public function delete($id);
    public function update($id, $attributes = []);
    public function edit($id, $attributes = []);
    public function find($id);
    public function all();
    public function orderBy($field, $direction = 'desc');
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null);
    public function where($column, $operator = null, $value = null, $boolean = 'and');
    public function orWhere($column, $operator = null, $value = null);
}

?>