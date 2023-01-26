<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get the Model instance.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the Model instance.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get data from model.
     *
     * @param array $relations
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = [])
    {
        return $this->model->with($relations)->get();
    }

    /**
     * Get data from model using pagination.
     *
     * @param int $perPage = 20
     * @param array $relations = []
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginate($perPage = 20, $relations = [])
    {
        return $this->model->with($relations)->paginate($perPage);
    }

    /**
     * Get the model data by id.
     *
     * @param string $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Generate data into the model.
     */
    public function create($datas = [])
    {
        return $this->model->create($datas);
    }
}
