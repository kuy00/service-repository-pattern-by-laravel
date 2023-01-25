<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    /**
     * ProductService Construct
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }
}
