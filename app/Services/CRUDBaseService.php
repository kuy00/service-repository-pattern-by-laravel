<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class CRUDBaseService
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * Get the BaseRepository instance.
     *
     * @return App\Repositories\BaseRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set the BaseRepository instance.
     *
     * @param App\Repositories\BaseRepository $repository
     * @return void
     */
    public function setRepository(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all data.
     *
     * @param array|null $relations
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = null)
    {
        return $this->repository->getAll($relations);
    }

    /**
     * Get all data with pagination.
     *
     * @param int|20 $perPage
     * @param array|null $relations
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginate($perPage = 20, $relations = null)
    {
        return $this->repository->getPaginate($perPage, $relations);
    }

    /**
     * Get data by id.
     *
     * @param string $id
     * @param array|null $relations
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getById($id, $relations = null)
    {
        return $this->repository->getById($id, $relations);
    }

    /**
     * Generate request data.
     *
     * @param array|null $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create($data = null)
    {
        return $this->repository->create($data);
    }

    /**
     * Update with request data.
     *
     * @param string $id
     * @param array|null $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function update($id, $data = null)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete with request data.
     *
     * @param string $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
