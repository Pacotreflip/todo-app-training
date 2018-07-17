<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function all(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    public function update(array $data, $id)
    {
        $recod = $this->find($id);
        return $recod->update($data);
    }
}