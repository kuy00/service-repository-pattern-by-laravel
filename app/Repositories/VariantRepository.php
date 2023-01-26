<?php

namespace App\Repositories;

use App\Models\Variant;
use App\Repositories\BaseRepository;

class VariantRepository extends BaseRepository
{
    public function __construct(Variant $variant)
    {
        $this->model = $variant;
    }
}
