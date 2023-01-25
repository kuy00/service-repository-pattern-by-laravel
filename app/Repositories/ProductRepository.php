<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll($relations = [])
    {
        return $this->product->with($relations)->get();
    }

    public function getPaginate($perPage = 20, $relations = [])
    {
        return $this->product->with($relations)->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->product->find($id);
    }

    public function create($datas = [])
    {
        return $this->product->create($datas);
    }
}
