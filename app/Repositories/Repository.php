<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
    public function all($columns = ['*']);

    public function list($orderByColumn, $orderBy = 'desc', $with = [], $columns = ['*']);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy(string $field, $value, $columns = array('*'));

    public function findAllBy(string $field, $value, $columns = array('*'));

    public function paginate($perPages = 15);

    public function setModel(Model $model);

    public function getModel();

}
