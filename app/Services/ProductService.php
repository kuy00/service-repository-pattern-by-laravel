<?php

namespace App\Services;

use App\Services\CRUDBaseService;
use App\Repositories\ProductRepository;

class ProductService extends CRUDBaseService
{
    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }
}
