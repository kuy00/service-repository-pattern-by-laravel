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
        return $this->repository->getAll();
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
        return $this->repository->getPaginate($perPage);
    }

    /**
     * Get data by id.
     *
     * @param string $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Generate request data.
     *
     * @param array|null $datas
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create($datas = null)
    {
        return $this->repository->create($datas);
    }
}
