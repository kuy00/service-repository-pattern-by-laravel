<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll($relations = []);
    public function getPaginate($perPage = 20, $relations = []);
    public function getById($id, $relations = []);

    public function create($data = []);
    public function update($id, $data = []);
    public function delete($id);
}
