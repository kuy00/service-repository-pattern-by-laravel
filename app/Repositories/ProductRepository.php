<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function create($datas = [])
    {
        return $this->product->create($datas);
    }
}
