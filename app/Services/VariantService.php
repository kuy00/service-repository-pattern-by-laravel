<?php

namespace App\Services;

use App\Services\CRUDBaseService;
use App\Repositories\VariantRepository;

class VariantService extends CRUDBaseService
{
    public function __construct(VariantRepository $variantRepository)
    {
        $this->repository = $variantRepository;
    }
}
