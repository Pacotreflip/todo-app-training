<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    /**
     * Regresa todos los registros
     *
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * Crea un nuevo registro y devuelde el registro creado
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * ELimina un registro dado un ID
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Busca y devuelve un registro dado un ID
     *
     * @param int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Agrega un ordenamiento al a consulta dada una columna y una dirección "ASC" o "DESC"
     *
     * @param string $column
     * @param string $direction
     * @return Repository
     */
    public function orderBy($column, $direction = 'ASC')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    /**
     * Modifica un registro dado un ID y datos actualizados y devuelve el registro modificado
     *
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, $id)
    {
        $recod = $this->find($id);
        $recod->update($data);
        return $recod;
    }
}