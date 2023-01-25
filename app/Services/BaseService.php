<?php

namespace App\Services;

class BaseService
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * BaseService Get All Data.
     *
     * @param array|null $relations
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAll($relations = null)
    {
        return $this->repository->getAll();
    }

    /**
     * BaseService Get All Data By Page.
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
     * BaseService Get Data By Id.
     *
     * @param string id
     * @return App\Models
     */
    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * BaseService Create For Request Data.
     *
     * @param array|null $datas
     * @return App\Models
     */
    public function create($datas = null)
    {
        return $this->repository->create($datas);
    }
}
