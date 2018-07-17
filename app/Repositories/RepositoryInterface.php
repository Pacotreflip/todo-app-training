<?php

namespace App\Repositories;


interface RepositoryInterface
{
    public function all(array $columns = ['*']);

    public function create(array $data);

    public function destroy($id);

    public function find($id);

    public function orderBy($column, $direction = 'ASC');

    public function update(array $data, $id);
}