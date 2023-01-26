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

    /**
     * Delete data into the model by product id.
     *
     * @param string $productId
     * @return Illuminate\Database\Eloquent\Model
     */
    public function deleteByProductId($productId)
    {
        return $this->model->where('product_id', $productId)->delete();
    }
}
